<?php

namespace App\Services;

use App\Models\Dealer;
use App\Traits\Response;

class DealerService
{
    use Response;

    /**
     * @param Dealer $dealer ;
     */
    private $dealer;

    /**
     * @return Dealer
     */
    public function getDealer()
    {
        return $this->dealer;
    }

    /**
     * @param Dealer $dealer
     */
    public function setDealer(Dealer $dealer): void
    {
        $this->dealer = $dealer;
    }

    public function getSubDealersIds($dealer_id)
    {
        $ids = [$dealer_id];
        if (($dealer = Dealer::find($dealer_id))->sub_dealers->count() > 0) {
            foreach ($dealer->sub_dealers as $sub_dealer) {
                $ids = array_merge($ids, $this->getSubDealersIds($sub_dealer->id));
            }
        }
        return $ids;
    }
}
