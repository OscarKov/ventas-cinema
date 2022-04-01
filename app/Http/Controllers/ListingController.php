<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieShow;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ListingController extends Controller
{
    public function getMovieListing($movie_id)
    {
        $movie = Movie::findOrFail($movie_id);
        $movie_shows = MovieShow::where('movie_id', $movie->id)
            ->where('available', 1)
            ->get();
        return Inertia::render('MovieListing', [
            'movie' => $movie,
            'shows' => $movie_shows
        ]);
    }
}
