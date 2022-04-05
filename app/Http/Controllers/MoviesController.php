<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieShow;
use App\Models\Room;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();
        return Inertia::render('dashboard/Movies', [
            'movies' => $movies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('dashboard/AddMovie');
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

        return redirect('/dashboard/movies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return Inertia::render('dashboard/EditMovie', [
            'movie' => $movie
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster_url' => 'required|string|max:255',
            'trailer_url' => 'required|string|max:255',
            'available' => 'required',
            'movie_length' => 'required'
        ]);

        $movie = Movie::find($id);
        $movie->update([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'poster_url' => $request->poster_url,
            'trailer_url' => $request->trailer_url,
            'available' => $request->available,
            'movie_length' => $request->movie_length
        ]);
        return redirect('/dashboard/movies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|numeric'
        ]);
        $movie = Movie::findOrFail($request->movie_id);
        $movie->delete();
        return redirect()->route('dashboard.movies');
    }

    public function getMovieShows($movie_id)
    {
        $movie = Movie::with(['shows'])->findOrFail($movie_id, ['id', 'title']);
        return Inertia::render('dashboard/MovieShows', [
            'movie' => $movie
        ]);
    }

    public function getAddShow()
    {
        $movies = Movie::all(['id', 'title']);
        $rooms = Room::all();
        return Inertia::render('dashboard/AddShow', [
            'movies' => $movies,
            'rooms' => $rooms
        ]);
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

        MovieShow::create([
            'movie_id' => $request->movie_id,
            'room_id' => $request->room_id,
            'starts_at' => $request->starts_at,
            'price' => $request->price,
            'available' => $request->available
        ]);

        return redirect()->route('movie.shows', [
            'id' => $request->movie_id
        ]);
    }

    public function getEditShow($show_id)
    {
        $show = MovieShow::findOrFail($show_id);
        $movies = Movie::all(['id', 'title']);
        $rooms = Room::all();
        return Inertia::render('dashboard/EditShow', [
            'show' => $show,
            'movies' => $movies,
            'rooms' => $rooms
        ]);
    }

    public function postEditShow(Request $request, $id)
    {
        $request->validate([
            'movie_id' => 'required|numeric',
            'room_id' => 'required|numeric',
            'starts_at' => 'required|date',
            'price' => 'required|numeric',
            'available' => 'required|boolean'
        ]);

        $show = MovieShow::findOrFail($id);
        $show->update([
            'movie_id' => $request->movie_id,
            'room_id' => $request->room_id,
            'starts_at' => $request->starts_at,
            'price' => $request->price,
            'available' => $request->available
        ]);
        return redirect()->route('movie.shows', [
            'id' => $request->movie_id
        ]);
    }
}
