<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\ContractStatus;
use App\Traits\Response;
use Yajra\DataTables\DataTables;

class ContractService
{
    use Response;

    /**
     * @param string|null $relation_type
     * @param int|null $relation_id
     */
    public function index(
        $relation_type = null,
        $relation_id = null
    )
    {
        $contracts = Contract::with([]);

        if ($relation_type && $relation_id) {
            $contracts->where('relation_type', $relation_type)->where('relation_id', $relation_id);
        }

        return $this->success('Contracts', $contracts->get());
    }

    /**
     * @param string|null $relation_type
     * @param int|null $relation_id
     */
    public function datatable(
        $relation_type = null,
        $relation_id = null
    )
    {
        $contracts = Contract::with([]);

        if ($relation_type && $relation_id) {
            $contracts->where('relation_type', $relation_type)->where('relation_id', $relation_id);
        }

        return DataTables::of($contracts)->
        filterColumn('status', function ($contracts, $data) {
            return $contracts->whereIn('status_id', ContractStatus::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        editColumn('start', function ($contract) {
            return date('d.m.Y', strtotime($contract->start));
        })->
        editColumn('end', function ($contract) {
            return date('d.m.Y', strtotime($contract->end));
        })->
        addColumn('status', function ($contract) {
            return $contract->status ? $contract->status->name : '';
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
        if (!$contract = Contract::find($id)) {
            return $this->error('Contract not found', 404);
        }

        return $this->success('Contract details', $contract);
    }

    /**
     * @param int|null $id
     * @param string $relation_type
     * @param int $relation_id
     * @param string $number
     * @param \DateTime $start
     * @param \DateTime $end
     * @param string|null $description
     * @param int $status_id
     * @param object $file
     */
    public function save(
        $id,
        $relation_type,
        $relation_id,
        $number,
        $start,
        $end,
        $description,
        $status_id,
        $file = null
    )
    {
        $contract = $id ? Contract::find($id) : new Contract;

        if ($id && !$contract) {
            return $this->error('Contract not found', 404);
        }

        $contract->relation_type = $relation_type;
        $contract->relation_id = $relation_id;
        $contract->number = $number;
        $contract->start = $start;
        $contract->end = $end;
        $contract->description = $description;
        $contract->status_id = $status_id;
        if ($file) {
            $name = $file->getClientOriginalName();
            $path = explodeNamespace($contract->relation_type) . '/' . $contract->relation_id . '/';
            $file->move($path, $name);
            $contract->file = $path . $name;
        } else {
            $contract->file = null;
        }
        $contract->save();

        return $this->success('Contract saved successfully', $contract);
    }

    /**
     * @param int $id
     */
    public function drop(
        $id
    )
    {
        if (!$contract = Contract::find($id)) {
            return $this->error('Contract not found', 404);
        }

        return $this->success('Contract deleted successfully', $contract->delete());
    }

    /**
     * @param int $id
     * @param object $file
     */
    public function uploadFile(
        $id,
        $file
    )
    {
        if (!$contract = Contract::find($id)) {
            return $this->error('Contract not found', 404);
        }

        $name = $file->getClientOriginalName();
        $path = explodeNamespace($contract->relation_type) . '/' . $contract->relation_id . '/';
        $file->move($path, $name);
        $contract->file = $path . $name;
        $contract->save();

        return $this->success('Contract file updated successfully', $contract);
    }
}
