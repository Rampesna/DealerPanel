<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Dealer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $appends = [
        'sub_dealers'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getSubDealersAttribute()
    {
        return Dealer::where('top_id', $this->id)->get();
    }
}
