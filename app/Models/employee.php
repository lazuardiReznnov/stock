<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class employee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function employeeEdu()
    {
        return $this->hasMany(employeeEdu::class);
    }

    public function employeeWeh()
    {
        return $this->hasMany(employeeWeh::class);
    }
}
