<?php

namespace App\Services;

use App\Models\Dealer;
use App\Traits\Response;
use Yajra\DataTables\DataTables;

class DealerService
{
    use Response;

    public function all()
    {
        return $this->success('All dealers', Dealer::all());
    }

    /**
     * @param int|null $dealer_id
     */
    public function index(
        $dealer_id = null
    )
    {
        $dealers = Dealer::with([]);

        if ($dealer_id) {
            $dealers->whereIn('dealer_id', (new DealerService)->getSubDealersIds($dealer_id));
        }

        return $this->success('All dealers', $dealers->get());
    }

    /**
     * @param int|null $dealer_id
     */
    public function datatable(
        $dealer_id = null
    )
    {
        $dealers = Dealer::with([]);

        if ($dealer_id) {
            $dealers->whereIn('dealer_id', $this->getSubDealersIds($dealer_id));
        }

        return DataTables::of($dealers)->
        filterColumn('top_id', function ($dealers, $data) {
            return $dealers->whereIn('top_id', Dealer::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        editColumn('top_id', function ($dealer) {
            return $dealer->top ? $dealer->top->name : '';
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
     * @param string|null $name
     * @param string|null $password
     */
    public function save(
        $id,
        $top_id,
        $tax_number,
        $name
    )
    {
        $dealer = $id ? Dealer::find($id) : new Dealer;

        if ($id && !$dealer) {
            return $this->error('Dealer not found', 404);
        }

        $dealer->top_id = $top_id;
        $dealer->tax_number = $tax_number;
        $dealer->name = $name;
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
        if (($dealer = Dealer::find($dealer_id))->sub_dealers->count() > 0) {
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
     */
    public function jsTree(
        $dealer_ids
    )
    {
        $dealers = [];
        foreach (Dealer::whereIn('id', $dealer_ids)->get() as $dealer) {
            $dealers[] = [
                'id' => 'dealer_' . $dealer->id,
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
}
