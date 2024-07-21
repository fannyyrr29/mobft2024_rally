<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama'
    ];

    public function result()
    {
        return $this->hasMany(Result::class);
    }

    public function posts() : BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'results',
            'group_id',
            'post_id'
        )
            ->withPivot(['result'])
            ->withTimestamps();
    }
}
