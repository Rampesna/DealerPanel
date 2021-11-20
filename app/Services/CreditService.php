<?php

namespace App\Services;

use App\Models\Credit;
use App\Models\RelationService;
use App\Models\Service;
use App\Traits\Response;
use Yajra\DataTables\DataTables;

class CreditService
{
    use Response;

    /**
     * @param string|null $relation_type
     * @param int|null $relation_id
     * @param int|null $relation_service_id
     */
    public function index(
        $relation_type = null,
        $relation_id = null,
        $relation_service_id = null
    )
    {
        $credits = Credit::with([
            'relation'
        ]);

        if ($relation_type && $relation_id) {
            $credits->where('relation_type', $relation_type)->where('relation_id', $relation_id);
        }

        if ($relation_service_id) {
            $credits->where('relation_service_id', $relation_service_id);
        }

        return $this->success('Credits', $credits->get());
    }

    /**
     * @param string|null $relation_type
     * @param int|null $relation_id
     * @param int|null $relation_service_id
     */
    public function datatable(
        $relation_type = null,
        $relation_id = null,
        $relation_service_id = null
    )
    {
        $credits = Credit::with([
            'relation'
        ]);

        if ($relation_type && $relation_id) {
            $credits->where('relation_type', $relation_type)->where('relation_id', $relation_id);
        }

        if ($relation_service_id) {
            $credits->where('relation_service_id', $relation_service_id);
        }

        return DataTables::of($credits)->
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
            return $credit->direction == 1 ? 'Alındı' : 'Kullanıldı';
        })->
        editColumn('amount', function ($credit) {
            return number_format($credit->amount, 2);
        })->
        addColumn('show_credit_details', function ($credit) {
            return $credit->direction == 0 ? '<i class="fa fa-plus-circle text-success cursor-pointer show_credit_details" data-id="' . $credit->id . '"></i>' : '';
        })->
        rawColumns([
            'show_credit_details'
        ])->
        make(true);
    }

    /**
     * @param int $id
     */
    public function show(
        $id
    )
    {
        $credit = Credit::find($id);

        if (!$credit) {
            return $this->error('Credit not found', 404);
        }

        return $this->success('Credit details', $credit);
    }

    /**
     * @param int|null $id
     * @param string $relation_type
     * @param int $relation_id
     * @param int|null $relation_service_id
     * @param double $amount
     * @param boolean $direction
     * @param string $description
     * @param string $auth_type
     * @param int $auth_id
     */
    public function save(
        $id,
        $relation_type,
        $relation_id,
        $relation_service_id,
        $amount,
        $direction,
        $description
    )
    {
        if (!$relation_id) {
            return $this->error('Relation not found', 404);
        }

        $credit = $id ? Credit::find($id) : new Credit;

        if ($id && !$credit) {
            return $this->error('Credit not found', 404);
        }

        $credit->relation_type = $relation_type;
        $credit->relation_id = $relation_id;
        $credit->relation_service_id = $relation_service_id;
        $credit->amount = $amount;
        $credit->direction = $direction;
        $credit->description = $description;
        $credit->save();

        return $this->success('Credit saved successfully', $credit);
    }
}
