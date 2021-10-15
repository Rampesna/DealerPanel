<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Receipt\GetPaidRequest;
use App\Services\ReceiptService;
use Illuminate\Support\Facades\Crypt;

class ReceiptController extends Controller
{
    private $receiptService;

    public function __construct()
    {
        $this->receiptService = new ReceiptService;
    }

    /**
     * @param GetPaidRequest $request
     */
    public function getPaid(GetPaidRequest $request)
    {
        return $this->receiptService->save(
            null,
            get_class($request->user),
            $request->user->id,
            $request->relation_type,
            $request->relation_id ?
                (gettype($request->relation_id) == 'integer' ? $request->relation_id : Crypt::decrypt($request->relation_id)) :
                ($request->relation_type::where('tax_number', $request->tax_number)->first()->id),
            0,
            null,
            $request->price
        );
    }
}
