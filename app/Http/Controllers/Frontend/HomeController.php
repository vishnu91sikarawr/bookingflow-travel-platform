<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\TripService;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\SearchTripRequest;
class HomeController extends Controller
{
    public function __construct(
        private readonly TripService $tripService
    ) {
    }

    public function index()
    {
        $cities = $this->tripService->getCities();

        return view('frontend.home', compact('cities'));
    }



    public function search(SearchTripRequest $request)
{
    $trips = $this->tripService->search($request->validated());

    return view('frontend.search', compact('trips'));
}

}
