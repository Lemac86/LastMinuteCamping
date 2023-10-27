<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Rating;
use App\Models\Campingground;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        // loads the users and joins the belonging rating 
        $usersWithRatings = $users->load('ratings');
        $ratings = Rating::all();
        // loads the ratings and joins the belonging user 
        $ratingsWithUsers = $ratings->load('user');
        $campinggrounds = Campingground::all();
        return Inertia::render('Dashboard', compact('users', 'ratings', 'campinggrounds','usersWithRatings'));
    }
}
