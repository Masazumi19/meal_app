<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Meal $meal)
    {
        $favorite = new Favorite;
        $favorite->user_id = Auth::id();
        $favorite->meal_id = $meal->id;
        $favorite->save();

        return redirect()->route('meals.show', $meal);
    }


    public function destroy($meal_id, $favorite_id)
    {
        $favorite = Favorite::find($favorite_id);
        $favorite->delete();

        return redirect("/meals/$meal_id");
    }
}
