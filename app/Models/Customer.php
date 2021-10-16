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
        'encrypted_id',
        'auth_type',
        'balance'
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

    public function getBalanceAttribute()
    {
        $credits = $this->credits;
        return $credits->where('direction', 1)->sum('amount') - $credits->where('direction', 0)->sum('amount');
    }

    public function services()
    {
        return $this->morphMany(RelationService::class, 'relation');
    }

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    public function credits()
    {
        return $this->morphMany(Credit::class, 'relation');
    }

    public function transactionStatus()
    {
        return $this->belongsTo(TransactionStatus::class);
    }

    public function contracts()
    {
        return $this->morphMany(Contract::class, 'relation');
    }
}
