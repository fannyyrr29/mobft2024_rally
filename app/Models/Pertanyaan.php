<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaans';

    protected $fillable = [
        'isi',
        'jawabanBenar',
        'kode',
        'gambar',
    ];

    public function teams() : BelongsToMany
    {
        return $this->belongsToMany(
            Team::class,
            'list_pertanyaan',
            'pertanyaan_id',
            'team_id',
        )
            ->withPivot(['status'])
            ->withTimestamps();
    }

    public function jawabans() : HasMany
    {
        return $this->hasMany(Jawaban::class, 'pertanyaan_id');
    }
}
