<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vrc extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
