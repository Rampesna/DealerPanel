<?php

namespace App\Services;

use App\Models\User;
use App\Traits\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

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

    /**
     *
     */
    public function index()
    {
        $users = User::with([]);

        return $this->success('All users', $users->get());
    }

    /**
     *
     */
    public function datatable()
    {
        $users = User::with([]);

        return DataTables::of($users)->make(true);
    }

    /**
     * @param int $id
     */
    public function show(
        $id
    )
    {
        if (!$user = User::with([])->find($id)) {
            return $this->error('User not found', 404);
        }

        return $this->success('User details', $user);
    }

    /**
     * @param int|null $id
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function save(
        $id,
        $name,
        $email,
        $password = null
    )
    {
        $user = $id ? User::find($id) : new User;

        if ($id && !$user) {
            return $this->error('User not found', 404);
        }

        $user->name = $name;
        $user->email = $email;
        if ($password) $user->password = $password;
        $user->save();

        return $this->success('User created successfully', $user);
    }

    /**
     * @param int $id
     */
    public function drop(
        $id
    )
    {
        if (!$user = User::find($id)) {
            return $this->error('User not found', 404);
        }

        return $this->success('User details', $user->delete());
    }

    /**
     * @param string $email
     * @param int $except_id
     */
    public function checkEmail(
        $email,
        $except_id = null
    )
    {
        $user = User::withTrashed();

        if ($except_id) {
            $user->where('id', '<>', $except_id);
        }

        return $this->success('Checking user email', $user->where('email', $email)->first() ? 1 : 0);
    }
}
