<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieShow extends Model
{
    use HasFactory;

    protected $fillable = [
        'starts_at',
        'available'
    ];

    protected $hidden = [
        'movie_id',
        'created_at',
        'updated_at',
        'room_id'
    ];

    protected $with = ['room'];

    protected $appends = ['sold_seats'];

    public function getSoldSeatsAttribute()
    {
        $seat_list = [];
        $purchases = Purchase::select(['seat'])->where('movie_show', $this->id)->get();
        foreach ($purchases as $key => $purchase) {
            array_push($seat_list, $purchase->seat);
        }
        return $seat_list;
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'movie_show');
    }
}
