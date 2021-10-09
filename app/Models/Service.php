<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'encrypted_id'
    ];

    public function customerServices()
    {
        return $this->hasMany(CustomerService::class);
    }
}
