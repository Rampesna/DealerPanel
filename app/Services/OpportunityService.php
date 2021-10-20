<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Dealer;
use App\Models\District;
use App\Models\Opportunity;
use App\Models\OpportunityStatus;
use App\Models\Province;
use App\Traits\Response;
use Yajra\DataTables\DataTables;

class OpportunityService
{
    use Response;

    /**
     * @param string|null $creator_type
     * @param int|null $creator_id
     * @param int|null $dealer_id
     */
    public function index(
        $creator_type = null,
        $creator_id = null,
        $dealer_id = null
    )
    {
        $opportunities = Opportunity::with([
            'creator',
            'dealer',
            'status',
            'country',
            'province',
            'district'
        ]);

        if ($creator_type && $creator_id) {
            $opportunities->where('creator_type', $creator_type)->where('creator_id', $creator_id);
        }

        if ($dealer_id) {
            $opportunities->where('dealer_id', $dealer_id);
        }

        return $this->success('Opportunities', $opportunities->get());
    }

    /**
     * @param string|null $creator_type
     * @param int|null $creator_id
     * @param int|null $dealer_id
     */
    public function datatable(
        $creator_type = null,
        $creator_id = null,
        $dealer_id = null
    )
    {
        $opportunities = Opportunity::with([
            'creator',
            'dealer',
            'status',
            'country',
            'province',
            'district'
        ]);

        if ($creator_type && $creator_id) {
            $opportunities->where('creator_type', $creator_type)->where('creator_id', $creator_id);
        }

        if ($dealer_id) {
            $opportunities->whereIn('dealer_id', (new DealerService)->getSubDealersIds($dealer_id));
        }

        return DataTables::of($opportunities)->
        filterColumn('dealer_id', function ($opportunities, $data) {
            return $opportunities->whereIn('dealer_id', Dealer::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('status_id', function ($opportunities, $data) {
            return $opportunities->whereIn('status_id', OpportunityStatus::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('country_id', function ($opportunities, $data) {
            return $opportunities->whereIn('country_id', Country::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('province_id', function ($opportunities, $data) {
            return $opportunities->whereIn('province_id', Province::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('district_id', function ($opportunities, $data) {
            return $opportunities->whereIn('district_id', District::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        editColumn('date', function ($opportunity) {
            return date('d.m.Y', strtotime($opportunity->date));
        })->
        editColumn('dealer_id', function ($opportunity) {
            return $opportunity->dealer ? $opportunity->dealer->name : '';
        })->
        editColumn('status_id', function ($opportunity) {
            return $opportunity->status ? $opportunity->status->name : '';
        })->
        editColumn('country_id', function ($opportunity) {
            return $opportunity->country ? $opportunity->country->name : '';
        })->
        editColumn('province_id', function ($opportunity) {
            return $opportunity->province ? $opportunity->province->name : '';
        })->
        editColumn('district_id', function ($opportunity) {
            return $opportunity->district ? $opportunity->district->name : '';
        })->
        make();
    }

    /**
     * @param int $id
     */
    public function show(
        $id
    )
    {
        $opportunity = Opportunity::with([
            'creator',
            'dealer',
            'status',
            'country',
            'province',
            'district'
        ])->find($id);

        if (!$opportunity) {
            return $this->error('Opportunity not found', 404);
        }

        return $this->success('Opportunity details', $opportunity);
    }

    /**
     * @param int|null $id
     * @param string $creator_type
     * @param int $creator_id
     * @param int|null $dealer_id
     * @param string $name
     * @param string $tax_number
     * @param string|null $tax_office
     * @param string|null $email
     * @param string|null $gsm
     * @param string|null $description
     * @param int|null $country_id
     * @param int|null $province_id
     * @param int|null $district_id
     * @param int $status_id
     * @param string $date
     */
    public function save(
        $id,
        $creator_type,
        $creator_id,
        $dealer_id,
        $name,
        $tax_number,
        $tax_office,
        $email,
        $gsm,
        $description,
        $country_id,
        $province_id,
        $district_id,
        $status_id,
        $date
    )
    {
        $opportunity = $id ? Opportunity::find($id) : new Opportunity;

        if ($id && !$opportunity) {
            return $this->error('Opportunity not found', 404);
        }

        $opportunity->creator_type = $creator_type;
        $opportunity->creator_id = $creator_id;
        $opportunity->dealer_id = $dealer_id;
        $opportunity->name = $name;
        $opportunity->tax_number = $tax_number;
        $opportunity->tax_office = $tax_office;
        $opportunity->email = $email;
        $opportunity->gsm = $gsm;
        $opportunity->description = $description;
        $opportunity->country_id = $country_id;
        $opportunity->province_id = $province_id;
        $opportunity->district_id = $district_id;
        $opportunity->status_id = $status_id;
        $opportunity->date = $date;
        $opportunity->save();

        return $this->success('Opportunity saved successfully', $opportunity);
    }

    /**
     * @param int $id
     */
    public function drop(
        $id
    )
    {
        $opportunity = Opportunity::find($id);

        if (!$opportunity) {
            return $this->error('Opportunity not found', 404);
        }

        return $this->success('Opportunity deleted successfully', $opportunity->delete());
    }
}
