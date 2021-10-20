<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opportunity extends Model
{
    use HasFactory, SoftDeletes;

    public function status()
    {
        return $this->belongsTo(OpportunityStatus::class, 'status_id', 'id');
    }

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function creator()
    {
        return $this->morphTo();
    }
}
