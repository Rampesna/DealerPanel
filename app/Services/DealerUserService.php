<?php

namespace App\Services;

use App\Models\DealerUser;
use App\Traits\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DealerUserService
{
    use Response;

    /**
     * @param string $email
     * @param string $password
     */
    public function login(
        $email,
        $password
    )
    {
        $dealerUser = DealerUser::where('email', $email)->first();

        if (!$dealerUser) {
            return $this->error('DealerUser not found', 404);
        }

        if (!Hash::check($password, $dealerUser->password)) {
            return $this->error('Credentials not correct', 400);
        }

        if (!$dealerUser->api_token) {
            $dealerUser->api_token = generateToken();
            $dealerUser->save();
        }

        return $this->success('DealerUser logged in successfully', $dealerUser);
    }

    /**
     * @param string $api_token
     */
    public function oAuthLogin(
        $api_token
    )
    {
        $dealerUser = DealerUser::where('api_token', $api_token)->first();

        if (!$dealerUser) {
            return $this->error('Token not correct!');
        }

        Auth::guard('dealerUser')->login($dealerUser);

        return $this->success('DealerUser logged in successfully with oAuth', $dealerUser);
    }
}
