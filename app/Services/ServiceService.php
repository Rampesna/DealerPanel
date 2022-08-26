<?php

namespace App\Services;

use App\Models\Service;
use App\Traits\Response;
use Yajra\DataTables\DataTables;

class ServiceService
{
    use Response;

    public function index()
    {
        return $this->success('Services', Service::all());
    }


    /**
     *
     */
    public function datatable()
    {
        $services = Service::with([]);

        return DataTables::of($services)->make(true);
    }

    /**
     * @param int $id
     */
    public function show(
        $id
    )
    {
        if (!$service = Service::with([])->find($id)) {
            return $this->error('User not found', 404);
        }

        return $this->success('Service details', $service);
    }

    public function create(
        $name,
        $creditAmount,
        $price
    )
    {
        $service = new Service;
        $service->name = $name;
        $service->credit_amount = $creditAmount;
        $service->price = $price;
        $service->save();

        return $this->success('Service created', $service);
    }

    public function update(
        $id,
        $name,
        $creditAmount,
        $price
    )
    {
        $service = Service::find($id);
        $service->name = $name;
        $service->credit_amount = $creditAmount;
        $service->price = $price;
        $service->save();

        return $this->success('Service updated', $service);
    }

    public function drop(
        $id
    )
    {
        return $this->success('Service deleted', Service::destroy($id));
    }
}
