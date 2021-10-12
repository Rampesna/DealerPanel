<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;

class Dealer extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $appends = [
        'sub_dealers',
        'encrypted_id'
    ];

    public function getEncryptedIdAttribute()
    {
        return Crypt::encrypt($this->id);
    }

    public function getSubDealersAttribute()
    {
        return Dealer::where('top_id', $this->id)->get();
    }

    public function top()
    {
        return $this->belongsTo(Dealer::class, 'top_id', 'id');
    }
}
