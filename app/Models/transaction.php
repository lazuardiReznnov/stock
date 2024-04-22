<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transaction extends Model
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

    public function invoicing()
    {
        return $this->belongsTo(Invoicing::class);
    }

    public function unit()
    {
        return $this->belongsTo(unit::class);
    }
    public function region()
    {
        return $this->belongsTo(region::class);
    }
}
