<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $appends = [
        'encrypted_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function apiToken()
    {
        return $this->api_token;
    }

    public function getEncryptedIdAttribute()
    {
        return Crypt::encrypt($this->id);
    }

    public function customerServices()
    {
        return $this->hasMany(CustomerService::class);
    }
}
