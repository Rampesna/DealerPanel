<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class RelationService extends Model
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

    public function relation()
    {
        return $this->morphTo()->withTrashed();
    }

    public function creator()
    {
        return $this->morphTo()->withTrashed();
    }

    public function status()
    {
        return $this->belongsTo(RelationServiceStatus::class, 'status_id', 'id')->withTrashed();
    }

    public function transactionStatus()
    {
        return $this->belongsTo(TransactionStatus::class)->withTrashed();
    }
}
