<?php

namespace App\Services;

use App\Models\Dealer;
use App\Models\TransactionStatus;
use App\Traits\Response;
use Yajra\DataTables\DataTables;

class DealerService
{
    use Response;

    /**
     * @param int|null $transaction_status_id
     */
    public function all(
        $transaction_status_id = null
    )
    {
        $dealers = Dealer::with([]);

        if ($transaction_status_id) {
            $dealers->where('transaction_status_id', $transaction_status_id);
        }

        return $this->success('All dealers', $dealers->get());
    }

    /**
     * @param int|null $dealer_id
     * @param int|null $transaction_status_id
     */
    public function index(
        $dealer_id = null,
        $transaction_status_id = null
    )
    {
        $dealers = Dealer::with([]);

        if ($dealer_id) {
            $dealers->whereIn('id', (new DealerService)->getSubDealersIds($dealer_id));
        }

        if ($transaction_status_id) {
            $dealers->where('transaction_status_id', $transaction_status_id);
        }

        return $this->success('Dealers', $dealers->get());
    }

    /**
     * @param int $dealer_id
     * @param int|null $transaction_status_id
     */
    public function subDealers(
        $dealer_id,
        $transaction_status_id = null
    )
    {
        $dealers = Dealer::with([]);

        if ($dealer_id) {
            $dealers->where('top_id', $dealer_id);
        }

        if ($transaction_status_id) {
            $dealers->where('transaction_status_id', $transaction_status_id);
        }

        return $this->success('Sub dealers', $dealers->get());
    }

    /**
     * @param int|null $dealer_id
     * @param int|null $transaction_status_id
     */
    public function datatable(
        $dealer_id = null,
        $transaction_status_id = null
    )
    {
        $dealers = Dealer::with([]);

        if ($dealer_id) {
            $dealers->whereIn('dealer_id', $this->getSubDealersIds($dealer_id));
        }

        if ($transaction_status_id) {
            $dealers->where('transaction_status_id', $transaction_status_id);
        }

        return DataTables::of($dealers)->
        filterColumn('transaction_status_id', function ($dealers, $data) {
            return $dealers->whereIn('transaction_status_id', TransactionStatus::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('top_id', function ($dealers, $data) {
            return $dealers->whereIn('top_id', Dealer::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        editColumn('top_id', function ($dealer) {
            return $dealer->top ? $dealer->top->name : '';
        })->
        editColumn('transaction_status_id', function ($dealer) {
            return $dealer->transactionStatus ? $dealer->transactionStatus->name : '';
        })->
        make(true);
    }

    /**
     * @param int $dealer_id
     * @param int|null $transaction_status_id
     */
    public function subDealersDatatable(
        $dealer_id,
        $transaction_status_id = null
    )
    {
        $dealers = Dealer::with([]);

        if ($dealer_id) {
            $dealers->where('top_id', $dealer_id);
        }

        if ($transaction_status_id) {
            $dealers->where('transaction_status_id', $transaction_status_id);
        }

        return DataTables::of($dealers)->
        filterColumn('transaction_status', function ($dealers, $data) {
            return $dealers->whereIn('transaction_status', TransactionStatus::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('top_id', function ($dealers, $data) {
            return $dealers->whereIn('top_id', Dealer::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        editColumn('top_id', function ($dealer) {
            return $dealer->top ? $dealer->top->name : '';
        })->
        addColumn('transaction_status', function ($dealer) {
            return $dealer->transactionStatus ? $dealer->transactionStatus->name : '';
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
        if (!$dealer = Dealer::find($id)) {
            return $this->error('Dealer not found', 404);
        }

        return $this->success('Dealer details', $dealer);
    }

    /**
     * @param int|null $id
     * @param int|null $top_id
     * @param string $tax_number
     * @param string $name
     * @param string|null $email
     * @param string|null $gsm
     * @param string|null $tax_office
     * @param string|null $website
     * @param string|null $foundation_date
     * @param int|null $country_id
     * @param int|null $province_id
     * @param int|null $district_id
     */
    public function save(
        $id,
        $top_id,
        $tax_number,
        $name,
        $email,
        $gsm,
        $tax_office,
        $website,
        $foundation_date,
        $country_id,
        $province_id,
        $district_id
    )
    {
        $dealer = $id ? Dealer::find($id) : new Dealer;

        if ($id && !$dealer) {
            return $this->error('Dealer not found', 404);
        }

        $dealer->top_id = $top_id;
        $dealer->tax_number = $tax_number;
        $dealer->name = $name;
        $dealer->email = $email;
        $dealer->gsm = $gsm;
        $dealer->tax_office = $tax_office;
        $dealer->website = $website;
        $dealer->foundation_date = $foundation_date;
        $dealer->country_id = $country_id;
        $dealer->province_id = $province_id;
        $dealer->district_id = $district_id;
        $dealer->save();

        return $this->success('Dealer created successfully', $dealer);
    }

    /**
     * @param int $id
     */
    public function drop(
        $id
    )
    {
        if (!$dealer = Dealer::find($id)) {
            return $this->error('Dealer not found', 404);
        }

        return $this->success('Dealer deleted successfully', $dealer->delete());
    }

    /**
     * @param int $dealer_id
     */
    public function getSubDealersIds(
        $dealer_id
    )
    {
        $ids = [$dealer_id];
        $dealer = Dealer::find($dealer_id);
        if (count($dealer->sub_dealers) > 0) {
            foreach ($dealer->sub_dealers as $sub_dealer) {
                $ids = array_merge($ids, $this->getSubDealersIds($sub_dealer->id));
            }
        }
        return $ids;
    }

    /**
     * @param string $tax_number
     * @param int $except_id
     */
    public function checkTaxNumber(
        $tax_number,
        $except_id = null
    )
    {
        $dealer = Dealer::withTrashed();

        if ($except_id) {
            $dealer->where('id', '<>', $except_id);
        }

        return $this->success('Checking dealer tax number', $dealer->where('tax_number', $tax_number)->first() ? 1 : 0);
    }

    /**
     * @param array $dealer_ids
     * @param int|null $transaction_status_id
     */
    public function jsTree(
        $dealer_ids,
        $transaction_status_id = null
    )
    {
        $model = Dealer::whereIn('id', $dealer_ids);

        if ($transaction_status_id) {
            $model->where('transaction_status_id', $transaction_status_id);
        }

        $dealers = [];
        foreach ($model->get() as $dealer) {
            $dealers[] = [
                'id' => 'dealer_' . $dealer->id,
                'top_id' => $dealer->top_id,
                'dealer_id' => $dealer->id,
                'type' => 'dealer',
                'icon' => 'far fa-building',
                'text' => $dealer->name,
                'state' => [
                    'opened' => true
                ],
                'children' => $dealer->sub_dealers->count() > 0 ? $this->jsTree($dealer->sub_dealers->pluck('id')->toArray()) : []
            ];
        }
        return $dealers;
    }

    /**
     * @param int $dealer_id
     * @param int $transaction_status_id
     */
    public function updateTransactionStatus(
        $dealer_id,
        $transaction_status_id
    )
    {
        $dealer = Dealer::find($dealer_id);

        if (!$dealer) {
            return $this->error('Dealer not found', 404);
        }

        $dealer->transaction_status_id = $transaction_status_id;
        $dealer->save();

        return $this->success('Dealer transaction status updated successfully', null);
    }
}
