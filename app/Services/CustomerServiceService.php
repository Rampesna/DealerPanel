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
     * @param int $customer_id
     * @param int $service_id
     */
    public function index(
        $customer_id = null,
        $service_id = null
    )
    {
        $customerServices = CustomerService::with([]);

        if ($customer_id) {
            $customerServices->where('customer_id', $customer_id);
        }

        if ($service_id) {
            $customerServices->where('service_id', $service_id);
        }

        return $this->success('All customer services', $customerServices->get());
    }

    /**
     * @param int $customer_id
     * @param int $service_id
     */
    public function datatable(
        $customer_id = null,
        $service_id = null
    )
    {
        $customerServices = CustomerService::with([]);

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
}
