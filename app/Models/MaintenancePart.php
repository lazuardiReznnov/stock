<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenancePart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }

    public function sparepart()
    {
        return $this->hasMany(Sparepart::class);
    }
}
