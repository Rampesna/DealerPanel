<?php

namespace App\Services;

use App\Models\Credit;
use App\Traits\Response;
use Yajra\DataTables\DataTables;

class CreditService
{
    use Response;

    /**
     * @param string|null $relation_type
     * @param int|null $relation_id
     * @param int|null $customer_service_id
     */
    public function index(
        ?string $relation_type,
        ?string $relation_id,
        ?string $customer_service_id
    )
    {
        $credits = Credit::with([
            'relation'
        ]);

        if ($relation_type && $relation_id) {
            $credits->where('relation_type', $relation_type)->where('relation_id', $relation_id);
        }

        if ($customer_service_id) {
            $credits->where('customer_service_id', $customer_service_id);
        }

        return $this->success('Credits', $credits->get());
    }

    /**
     * @param string|null $relation_type
     * @param int|null $relation_id
     * @param int|null $customer_service_id
     */
    public function datatable(
        ?string $relation_type,
        ?string $relation_id,
        ?string $customer_service_id
    )
    {
        $credits = Credit::with([
            'relation'
        ]);

        if ($relation_type && $relation_id) {
            $credits->where('relation_type', $relation_type)->where('relation_id', $relation_id);
        }

        if ($customer_service_id) {
            $credits->where('customer_service_id', $customer_service_id);
        }

        return DataTables::of($credits)->
        editColumn('relation_id', function ($credit) {
            return $credit->relation ? $credit->relation->name : '';
        })->
        editColumn('customer_service_id', function ($credit) {
            return $credit->service ? $credit->service->name : '';
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
     * @param int|null $customer_service_id
     * @param double $amount
     * @param boolean $direction
     * @param string $description
     */
    public function save(
        ?int   $id,
        string $relation_type,
        int    $relation_id,
        ?int   $customer_service_id,
        float  $amount,
        bool   $direction,
        string $description
    )
    {
        $credit = $id ? Credit::find($id) : new Credit;

        if ($id && !$credit) {
            return $this->error('Credit not found', 404);
        }

        $credit->relation_type = $relation_type;
        $credit->relation_id = $relation_id;
        $credit->customer_service_id = $customer_service_id;
        $credit->amount = $amount;
        $credit->direction = $direction;
        $credit->description = $description;
        $credit->save();

        return $this->success('Credit saved successfully', $credit);
    }
}
