<?php

namespace App\Services\Auth;

use App\Models\Dealer;

class DealerAuthService
{
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

    public function login(
        $tax_number,
        $password
    )
    {

    }
}
