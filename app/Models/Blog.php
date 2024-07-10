<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categoryblog(): BelongsTo
    {
        return $this->belongsTo(categoryblog::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
