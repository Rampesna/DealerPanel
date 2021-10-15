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
        return $this->creditService->save(
            null,
            $request->relation_type,
            $request->relation_id ?
                (gettype($request->relation_id) == 'integer' ? $request->relation_id : Crypt::decrypt($request->relation_id)) :
                ($request->relation_type::where('tax_number', $request->tax_number)->first()->id),
            null,
            $request->amount,
            0,
            $request->desciption
        );
    }
}
