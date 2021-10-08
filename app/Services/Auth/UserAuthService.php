<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Traits\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthService
{
    use Response;

    private $user;

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function login(
        $email,
        $password
    )
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return $this->error('User not found', 404);
        }

        if (!Hash::check($password, $user->password)) {
            return $this->error('Credentials not correct', 404);
        }

        if (!$user->api_token) {
            $user->api_token = generateToken();
            $user->save();
        }

        return $this->success('User logged in successfully', $user);
    }

    public function oAuthLogin(
        $api_token
    )
    {
        $user = User::where('api_token', $api_token)->first();

        if (!$user) {
            return $this->error('Token not correct!');
        }

        Auth::guard('user')->login($user);

        return $this->success('User logged in successfully with oAuth', $user);
    }
}
