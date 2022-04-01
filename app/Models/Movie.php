<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'poster_url',
        'trailer_url',
        'available',
        'movie_length'
    ];

    protected $hidden = ['shows'];

    public function shows()
    {
        return $this->hasMany(MovieShow::class);
    }
}
