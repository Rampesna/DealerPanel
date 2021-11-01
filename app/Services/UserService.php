<?php

namespace App\Services;

use App\Models\User;
use App\Traits\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
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
        $user = User::where('email', $email)->first();

        if (!$user) {
            return $this->error('User not found', 404);
        }

        if (!Hash::check($password, $user->password)) {
            return $this->error('Credentials not correct', 400);
        }

        if (!$user->api_token) {
            $user->api_token = generateToken();
            $user->save();
        }

        return $this->success('User logged in successfully', [
            'api_token' => $user->api_token
        ]);
    }

    /**
     * @param string $api_token
     */
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

    /**
     * @param int $user_id
     * @param string $password
     */
    public function checkPassword(
        $user_id,
        $password
    )
    {
        $user = User::find($user_id);

        if (!$user) {
            return $this->error('User not found', 404);
        }

        return $this->success('User password check status', Hash::check($password, $user->password) ? 1 : 0);
    }

    /**
     * @param int $user_id
     * @param string $password
     */
    public function updatePassword(
        $user_id,
        $password
    )
    {
        $user = User::find($user_id);

        if (!$user) {
            return $this->error('User not found', 404);
        }

        $user->password = $password;
        $user->save();

        return $this->success('User password updated successfully', null);
    }
}
