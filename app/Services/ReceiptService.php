<?php

namespace App\Services;

use App\Models\Receipt;
use App\Models\RelationService;
use App\Models\Service;
use App\Traits\Response;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class ReceiptService
{
    use Response;

    /**
     * @param string|null $creator_type
     * @param int|null $creator_int
     * @param string|null $relation_type
     * @param int|null $relation_id
     */
    public function index(
        $creator_type = null,
        $creator_id = null,
        $relation_type = null,
        $relation_id = null
    )
    {
        $receipts = Receipt::with([]);

        if ($creator_type && $creator_id) {
            $receipts->where('creator_type', $creator_type)->where('creator_id', $creator_id);
        }

        if ($relation_type && $relation_id) {
            $receipts->where('relation_type', $relation_type)->where('relation_id', $relation_id);
        }

        return $this->success('Receipts', $receipts->get());
    }

    /**
     * @param string|null $creator_type
     * @param int|null $creator_int
     * @param string|null $relation_type
     * @param int|null $relation_id
     */
    public function datatable(
        $creator_type = null,
        $creator_id = null,
        $relation_type = null,
        $relation_id = null
    )
    {
        $receipts = Receipt::with([]);

        if ($creator_type && $creator_id) {
            $receipts->where('creator_type', $creator_type)->where('creator_id', $creator_id);
        }

        if ($relation_type && $relation_id) {
            $receipts->where('relation_type', $relation_type)->where('relation_id', $relation_id);
        }

        return DataTables::of($receipts)->
        filterColumn('created_at', function ($credits, $data) {
            return $credits->where('created_at', '>=', $data);
        })->
        filterColumn('relation_service_id', function ($credits, $data) {
            return $credits->whereIn(
                'relation_service_id',
                RelationService::whereIn(
                    'service_id',
                    Service::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray()
                )->pluck('id')->toArray()
            );
        })->
        editColumn('relation_id', function ($credit) {
            return $credit->relation ? $credit->relation->name : '';
        })->
        editColumn('relation_service_id', function ($credit) {
            return $credit->service ? $credit->service->name : '--';
        })->
        editColumn('created_at', function ($credit) {
            return date('d.m.Y, H:i', strtotime($credit->created_at));
        })->
        editColumn('direction', function ($credit) {
            return $credit->direction == 1 ? 'Satın Alım' : 'Ödeme';
        })->
        editColumn('price', function ($credit) {
            return $credit->price . ' TL';
        })->
        make(true);
    }

    /**
     * @param int|string $id
     */
    public function show(
        $id
    )
    {
        $receipt = Receipt::find(Receipt::find(gettype($id) == 'integer' ? $id : Crypt::decrypt($id)));

        if (!$receipt) {
            return $this->error('Receipt not found', 404);
        }

        return $this->success('Receipt details', $receipt);
    }

    /**
     * @param int|null $id
     * @param string $creator_type
     * @param int $creator_id
     * @param string $relation_type
     * @param int $relation_id
     * @param int|null $relation_service_id
     * @param double $price
     */
    public function save(
        $id,
        $creator_type,
        $creator_id,
        $relation_type,
        $relation_id,
        $direction,
        $relation_service_id,
        $price
    )
    {
        $receipt = $id ? Receipt::find($id) : new Receipt;

        if ($id && !$receipt) {
            return $this->error('Receipt not found', 404);
        }

        $receipt->creator_type = $creator_type;
        $receipt->creator_id = $creator_id;
        $receipt->relation_type = $relation_type;
        $receipt->relation_id = $relation_id;
        $receipt->direction = $direction;
        $receipt->relation_service_id = $relation_service_id;
        $receipt->price = $price;
        $receipt->save();

        return $this->success('Receipt saved successfully', $receipt);
    }

    /**
     * @param int|string $id
     */
    public function drop(
        $id
    )
    {
        $receipt = Receipt::find(Receipt::find(gettype($id) == 'integer' ? $id : Crypt::decrypt($id)));

        if (!$receipt) {
            return $this->error('Receipt not found', 404);
        }

        return $this->success('Receipt deleted successfully', $receipt->delete());
    }
}
