<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $listing_items = Movie::all();
        return Inertia::render('Home', [
            'listingItems' => $listing_items
        ]);
    }
}
