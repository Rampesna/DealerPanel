<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;

class DealerUser extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'encrypted_id',
        'auth_type'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function apiToken()
    {
        return $this->api_token;
    }

    public function authType()
    {
        return get_class($this);
    }

    public function getAuthTypeAttribute()
    {
        return get_class($this);
    }

    public function getEncryptedIdAttribute()
    {
        return Crypt::encrypt($this->id);
    }

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    public function getDealerId()
    {
        return $this->dealer_id;
    }
}
