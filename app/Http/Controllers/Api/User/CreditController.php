<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Credit\DeductionRequest;
use App\Services\CreditService;
use Illuminate\Support\Facades\Crypt;

class CreditController extends Controller
{
    private $creditService;

    public function __construct()
    {
        $this->creditService = new CreditService;
    }

    /**
     * @param DeductionRequest $request
     */
    public function deduction(DeductionRequest $request)
    {
        $relation = $request->relation_type::where('tax_number', $request->tax_number)->first();

        $file = fopen(public_path(date('Y_m_d') . '_credits_logs.txt'), 'w');
        fwrite($file, date('Y-m-d H:i:s') . '   =>   Relation: ' . serialize($relation));
        fclose($file);

        if ($relation) {
            return $this->creditService->save(
                null,
                $request->relation_type,
                $relation->id,
                null,
                $request->amount,
                0,
                $request->desciption
            );
        } else {
            return response()->json([
                'message' => 'Relation not found',
                'error' => true,
                'code' => 404,
                'response' => null
            ], 404);
        }
    }
}
