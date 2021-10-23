<?php

namespace App\Services;

use App\Mail\SendDealerUserPasswordEmail;
use App\Models\Dealer;
use App\Models\DealerUser;
use App\Traits\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

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

    /**
     * @param int|null $dealer_id
     */
    public function index(
        $dealer_id
    )
    {
        $dealerUsers = Dealer::with([]);

        if ($dealer_id) {
            $dealerUsers->where('dealer_id', $dealer_id);
        }

        return $this->success('Dealer users', $dealerUsers->get());
    }

    /**
     * @param int|null $dealer_id
     */
    public function datatable(
        $dealer_id
    )
    {
        $dealerUsers = DealerUser::with([]);

        if ($dealer_id) {
            $dealerUsers->where('dealer_id', $dealer_id);
        }

        return DataTables::of($dealerUsers)->
        filterColumn('dealer', function ($dealerUsers, $data) {
            return $dealerUsers->where('dealer_id', Dealer::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        addColumn('dealer', function ($dealerUser) {
            return $dealerUser->dealer ? $dealerUser->dealer->name : '';
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
        $dealerUser = DealerUser::find($id);

        if (!$dealerUser) {
            return $this->error('Dealer user not found', 404);
        }

        return $this->success('Dealer user details', $dealerUser);
    }

    /**
     * @param int|null $id
     * @param int $dealer_id
     * @param string $name
     * @param string $email
     */
    public function save(
        $id,
        $dealer_id,
        $name,
        $email
    )
    {
        $dealerUser = $id ? DealerUser::find($id) : new DealerUser;

        if ($id && !$dealerUser) {
            return $this->error('Dealer user not found', 404);
        }

        $dealerUser->dealer_id = $dealer_id;
        $dealerUser->name = $name;
        $dealerUser->email = $email;
        $dealerUser->save();

        return $this->success('Dealer user saved successfully', $dealerUser);
    }

    /**
     * @param int $id
     */
    public function drop(
        $id
    )
    {
        $dealerUser = DealerUser::find($id);

        if (!$dealerUser) {
            return $this->error('Dealer user not found', 404);
        }

        return $this->success('Dealer user deleted successfully', $dealerUser->delete());
    }

    /**
     * @param int $id
     */
    public function sendPassword(
        $id
    )
    {
        $dealerUser = DealerUser::find($id);

        if (!$dealerUser) {
            return $this->error('Dealer user not found', 404);
        }

        $password = Str::random(8);
        $dealerUser->password = bcrypt($password);
        Mail::to($dealerUser->email)->send(new SendDealerUserPasswordEmail($dealerUser->name, $dealerUser->email, $password));
        $dealerUser->save();

        return $this->success('Dealer user password successfully sent', null);
    }
}
