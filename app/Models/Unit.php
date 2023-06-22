<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function spesification()
    {
        return $this->hasOne(Spesification::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function vrc()
    {
        return $this->hasOne(Vrc::class);
    }

    public function vpic()
    {
        return $this->hasOne(Vpic::class);
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }
}
