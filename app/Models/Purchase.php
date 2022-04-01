<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail',
        'price',
        'seat',
        'user_id',
        'movie_show'
    ];

    public function movie_show()
    {
        return $this->belongsTo(MovieShow::class);
    }
}
