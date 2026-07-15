<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Models\Trip;
use App\Services\TripService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TripController extends Controller
{
    public function __construct(
        private TripService $tripService
    ) {}

    public function index(Request $request): View
    {
        $trips = $this->tripService->paginate(
            $request->search
        );

        return view('admin.trips.index', compact('trips'));
    }

    public function create(): View
    {
        return view('admin.trips.create', [
            'busOperators' => $this->tripService->getBusOperators(),
            'buses' => $this->tripService->getBuses(),
            'busRoutes' => $this->tripService->getBusRoutes(),
        ]);
    }

    public function store(StoreTripRequest $request): RedirectResponse
    {
        $this->tripService->create(
            $request->validated(),
            auth()->id()
        );

        return redirect()
            ->route('trips.index')
            ->with('success', 'Trip created successfully.');
    }

    public function edit(Trip $trip): View
    {
        return view('admin.trips.edit', [
            'trip' => $trip,
            'busOperators' => $this->tripService->getBusOperators(),
            'buses' => $this->tripService->getBuses(),
            'busRoutes' => $this->tripService->getBusRoutes(),
        ]);
    }

    public function update(
        UpdateTripRequest $request,
        Trip $trip
    ): RedirectResponse {

        $this->tripService->update(
            $trip,
            $request->validated(),
            auth()->id()
        );

        return redirect()
            ->route('trips.index')
            ->with('success', 'Trip updated successfully.');
    }

    public function destroy(Trip $trip): RedirectResponse
    {
        $this->tripService->delete($trip);

        return redirect()
            ->route('trips.index')
            ->with('success', 'Trip deleted successfully.');
    }
}
