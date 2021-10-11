<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportRequestMessage extends Model
{
    use HasFactory, SoftDeletes;

    public function creator()
    {
        return $this->morphTo();
    }

    public function files()
    {
        return $this->morphTo();
    }
}
