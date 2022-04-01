<?php

namespace App\Http\Controllers;

use App\Models\MovieShow;
use App\Models\Purchase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\throwException;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        $request->validate([
            'showId' => 'required|numeric',
            'seats' => 'required|array'
        ]);

        $user = Auth::user();
        $show = MovieShow::findOrFail($request->showId);
        $seats = $request->seats;
        $seat_count = count($seats);

        $total_price = $seat_count * $show->price;

        foreach ($seats as $key => $seat) {
            Purchase::create([
                'detail' => $request->detail,
                'price' => $show->price,
                'seat' => $seat,
                'user_id' => $user->id,
                'movie_show' => $show->id
            ]);

            if ($show->tickets_sold < $show->room->max_quota) {
                $show->tickets_sold++;
                $show->save();
            } else {
                throw new Exception('Sala llena');
            }
        }

        return redirect(route('movieListing', ['movie_id' => $show->movie_id]));
    }
}
