<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class CustomerService extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'encrypted_id'
    ];

    public function getEncryptedIdAttribute()
    {
        return Crypt::encrypt($this->id);
    }

    public function service()
    {
        return $this->belongsTo(Service::class)->withTrashed();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }

    public function status()
    {
        return $this->belongsTo(CustomerServiceStatus::class, 'status_id', 'id')->withTrashed();
    }
}
