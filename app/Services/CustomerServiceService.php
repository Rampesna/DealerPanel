<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\CustomerService;
use App\Models\CustomerServiceStatus;
use App\Models\Service;
use App\Traits\Response;
use Yajra\DataTables\DataTables;

class CustomerServiceService
{
    use Response;

    /**
     * @param int|null $customer_id
     * @param int|null $service_id
     * @param int|null $transaction_status_id
     */
    public function index(
        $customer_id = null,
        $service_id = null,
        $transaction_status_id = null
    )
    {
        $customerServices = CustomerService::with([]);

        if ($transaction_status_id) {
            $customerServices->where('transaction_status_id', $transaction_status_id);
        }

        if ($customer_id) {
            $customerServices->where('customer_id', $customer_id);
        }

        if ($service_id) {
            $customerServices->where('service_id', $service_id);
        }

        return $this->success('All customer services', $customerServices->get());
    }

    /**
     * @param int|null $customer_id
     * @param int|null $service_id
     * @param int|null $transaction_status_id
     */
    public function datatable(
        $customer_id = null,
        $service_id = null,
        $transaction_status_id = null
    )
    {
        $customerServices = CustomerService::with([]);

        if ($transaction_status_id) {
            $customerServices->where('transaction_status_id', $transaction_status_id);
        }

        if ($customer_id) {
            $customerServices->where('customer_id', $customer_id);
        }

        if ($service_id) {
            $customerServices->where('service_id', $service_id);
        }

        return DataTables::of($customerServices)->
        filterColumn('service_id', function ($customerServices, $data) {
            return $customerServices->whereIn('service_id', Service::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('customer_id', function ($customerServices, $data) {
            return $customerServices->whereIn('customer_id', Customer::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('status_id', function ($customerServices, $data) {
            return $customerServices->whereIn('status_id', CustomerServiceStatus::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('start', function ($customerServices, $data) {
            return $customerServices->where('start', '>=', $data);
        })->
        filterColumn('end', function ($customerServices, $data) {
            return $customerServices->where('end', '<=', $data);
        })->
        editColumn('service_id', function ($customerService) {
            return $customerService->service ? $customerService->service->name : '';
        })->
        editColumn('customer_id', function ($customerService) {
            return $customerService->customer ? $customerService->customer->name : '';
        })->
        editColumn('status_id', function ($customerService) {
            return $customerService->status ? $customerService->status->name : '';
        })->
        editColumn('start', function ($customerService) {
            return $customerService->start ? date('d.m.Y, H:i', strtotime($customerService->start)) : '--';
        })->
        editColumn('end', function ($customerService) {
            return $customerService->start ? date('d.m.Y, H:i', strtotime($customerService->end)) : '--';
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
        $customerService = CustomerService::find($id);

        if (!$customerService) {
            return $this->error('Customer service not found', 404);
        }

        return $this->success('Customer service details', $customerService);
    }

    /**
     * @param int|null $id
     */
    public function save(
        $id
    )
    {
        $customerService = $id ? CustomerService::find($id) : new CustomerService;

        if ($id && !$customerService) {
            return $this->error('Customer service not found', 404);
        }
    }

    /**
     * @param int $id
     */
    public function drop(
        $id
    )
    {
        $customerService = CustomerService::find($id);

        if (!$customerService) {
            return $this->error('Customer service not found', 404);
        }

        return $this->success('Customer service deleted successfully', $customerService->delete());
    }
}
