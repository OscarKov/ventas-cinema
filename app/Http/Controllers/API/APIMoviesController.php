<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\MovieShow;
use Illuminate\Http\Request;

class APIMoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::where('available', 1)->get();
        return $movies;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster_url' => 'required|string|max:255',
            'trailer_url' => 'required|string|max:255',
            'available' => 'required',
            'movie_length' => 'required'
        ]);

        $movie = new Movie([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'poster_url' => $request->poster_url,
            'trailer_url' => $request->trailer_url,
            'available' => $request->available,
            'movie_length' => $request->movie_length
        ]);

        $movie->save();

        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return $movie;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster_url' => 'required|string|max:255',
            'trailer_url' => 'required|string|max:255',
            'available' => 'required',
            'movie_length' => 'required'
        ]);

        $movie = Movie::find($request->id);
        $movie->update([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'poster_url' => $request->poster_url,
            'trailer_url' => $request->trailer_url,
            'available' => $request->available,
            'movie_length' => $request->movie_length
        ]);

        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return ['message' => 'succesfull'];
    }

    public function getMovieShows($movie_id)
    {
        $movie = Movie::with(['shows'])->findOrFail($movie_id, ['id', 'title']);
        return $movie;
    }

    public function postAddShow(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|numeric',
            'room_id' => 'required|numeric',
            'starts_at' => 'required|date',
            'price' => 'required|numeric',
            'available' => 'required|boolean'
        ]);

        $show = new MovieShow([
            'movie_id' => $request->movie_id,
            'room_id' => $request->room_id,
            'starts_at' => $request->starts_at,
            'price' => $request->price,
            'available' => $request->available
        ]);

        $show->save();

        return $show;
    }

    public function putEditShow(Request $request, $id)
    {
        $show = MovieShow::findOrFail($id);

        $request->validate([
            'room_id' => 'required|numeric',
            'starts_at' => 'required|date',
            'price' => 'required|numeric',
            'available' => 'required|boolean'
        ]);

        $show->update([
            'room_id' => $request->room_id,
            'starts_at' => $request->starts_at,
            'price' => $request->price,
            'available' => $request->available
        ]);

        return $show;
    }
}
