<?php

namespace App\Services\Auth;

use App\Models\Dealer;
use App\Traits\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DealerAuthService
{
    use Response;

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
        $dealer = Dealer::where('tax_number', $tax_number)->first();

        if (!$dealer) {
            return $this->error('Dealer not found', 404);
        }

        if (!Hash::check($password, $dealer->password)) {
            return $this->error('Credentials not correct', 400);
        }

        if (!$dealer->api_token) {
            $dealer->api_token = generateToken();
            $dealer->save();
        }

        return $this->success('Dealer logged in successfully', $dealer);
    }

    public function oAuthLogin(
        $api_token
    )
    {
        $dealer = Dealer::where('api_token', $api_token)->first();

        if (!$dealer) {
            return $this->error('Token not correct!');
        }

        Auth::guard('dealer')->login($dealer);

        return $this->success('Dealer logged in successfully with oAuth', $dealer);
    }
}
