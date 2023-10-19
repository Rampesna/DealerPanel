<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Http\Request;
use Rampesna\JqxGrid;

class PaymentService
{
    public function getAll()
    {
        return Payment::all();
    }

    public function getApproved()
    {
        return Payment::with([
            'relation' => function ($query) {
                $query->withTrashed();
            },
        ])->where('approved', 1)->get();
    }

    public function testJqxServerSide(Request $request)
    {
        $table = 'payments';
        $columns = [
            'id',
        ];

        $jqxGrid = new JqxGrid($table, $columns, $request);

        return $jqxGrid->initialize();
    }

    public function getById(
        $id
    )
    {
        return Payment::find($id);
    }

    public function getByOrderId(
        $orderId
    )
    {
        return Payment::where('order_id', $orderId)->first();
    }

    public function create(
        $creatorType,
        $creatorId,
        $relationType,
        $relationId,
        $orderId,
        $amount
    )
    {
        $payment = new Payment;
        $payment->creator_type = $creatorType;
        $payment->creator_id = $creatorId;
        $payment->relation_type = $relationType;
        $payment->relation_id = $relationId;
        $payment->order_id = $orderId;
        $payment->amount = $amount;
        $payment->save();

        return $payment;
    }
}
