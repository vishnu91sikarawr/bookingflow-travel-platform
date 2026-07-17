<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Trip;

class SeatSelectionController extends Controller
{
   public function index(Trip $trip)
{
    return view('frontend.seat-selection', compact('trip'));
}
}
