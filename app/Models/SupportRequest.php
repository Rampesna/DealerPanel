<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class SupportRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'encrypted_id'
    ];

    public function getEncryptedIdAttribute()
    {
        return Crypt::encrypt($this->id);
    }

    public function creator()
    {
        return $this->morphTo();
    }

    public function category()
    {
        return $this->belongsTo(SupportRequestCategory::class);
    }

    public function priority()
    {
        return $this->belongsTo(SupportRequestPriority::class);
    }

    public function status()
    {
        return $this->belongsTo(SupportRequestStatus::class);
    }

    public function messages()
    {
        return $this->hasMany(SupportRequestMessage::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'relation');
    }
}
