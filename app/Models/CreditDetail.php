<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class CreditDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'encrypted_id'
    ];

    public function getEncryptedIdAttribute()
    {
        return Crypt::encrypt($this->id);
    }

    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }

    public function type()
    {
        return $this->belongsTo(CreditDetailType::class, 'type_id', 'id');
    }
}
