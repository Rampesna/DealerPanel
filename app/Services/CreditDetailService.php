<?php

namespace App\Services;

use App\Models\CreditDetail;
use App\Models\CreditDetailType;
use App\Traits\Response;
use Yajra\DataTables\DataTables;

class CreditDetailService
{
    use Response;

    /**
     * @param int|null $credit_id
     */
    public function index(
        $credit_id = null
    )
    {
        $creditDetails = CreditDetail::with([
            'credit',
            'type'
        ]);

        if ($credit_id) {
            $creditDetails->where('credit_id', $credit_id);
        }

        return $this->success('Credit details', $creditDetails->get());
    }

    /**
     * @param int|null $credit_id
     */
    public function datatable(
        $credit_id = null
    )
    {
        $creditDetails = CreditDetail::with([
            'credit',
            'type'
        ]);

        if ($credit_id) {
            $creditDetails->where('credit_id', $credit_id);
        }

        return DataTables::of($creditDetails)->
        filterColumn('type', function ($creditDetails, $data) {
            return $creditDetails->whereIn('type_id', CreditDetailType::select(['id'])->where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        editColumn('amount', function ($creditDetail) {
            return number_format($creditDetail->amount, 2);
        })->
        addColumn('type', function ($creditDetail) {
            return $creditDetail->type ? $creditDetail->type->name : '';
        })->
        make(true);
    }

    /**
     * @param int $id
     */
    public function show(
        $id
    )
    {
        $creditDetail = CreditDetail::find($id);

        if (!$creditDetail) {
            return $this->error('Credit detail not found');
        }

        return $this->success('Credit detail', $creditDetail);
    }

    /**
     * @param int|null $id
     * @param int $credit_id
     * @param int $type_id
     * @param int $amount
     */
    public function save(
        $id,
        $credit_id,
        $type_id,
        $amount
    )
    {
        $creditDetail = $id ? CreditDetail::find($id) : new CreditDetail;

        if ($id && !$creditDetail) {
            return $this->error('Credit detail not found', null);
        }

        $creditDetail->credit_id = $credit_id;
        $creditDetail->type_id = $type_id;
        $creditDetail->amount = $amount;
        $creditDetail->save();

        $file = fopen(public_path(date('Y_m_d') . '_credit_details_logs.txt'), 'w');
        fwrite($file, date('Y-m-d H:i:s') . '   =>   Credit Detail: ' . serialize($creditDetail));
        fclose($file);

        return $this->success('Credit detail saved successfully', $creditDetail);
    }

    /**
     * @param int $id
     */
    public function drop(
        $id
    )
    {
        $creditDetail = CreditDetail::find($id);

        if (!$creditDetail) {
            return $this->error('Credit detail not found');
        }

        return $this->success('Credit detail deleted successfully', $creditDetail->delete());
    }
}
