<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelationServiceStatus extends Model
{
    use HasFactory, SoftDeletes;

    public function services()
    {
        return $this->hasMany(RelationService::class, 'status_id', 'id');
    }
}
