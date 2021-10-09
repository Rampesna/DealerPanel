<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerServiceStatus extends Model
{
    use HasFactory, SoftDeletes;

    public function services()
    {
        return $this->hasMany(CustomerService::class, 'status_id', 'id');
    }
}
