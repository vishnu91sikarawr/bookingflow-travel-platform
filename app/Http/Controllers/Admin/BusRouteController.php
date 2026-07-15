<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusRoute\StoreBusRouteRequest;
use App\Http\Requests\BusRoute\UpdateBusRouteRequest;
use App\Models\BusRoute;
use App\Services\BusRouteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BusRouteController extends Controller
{
    public function __construct(
        private BusRouteService $busRouteService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $busRoutes = $this->busRouteService->paginate(
            $request->get('search')
        );

        return view('admin.bus-routes.index', compact('busRoutes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $busOperators = $this->busRouteService->getBusOperators();

        return view('admin.bus-routes.create', compact('busOperators'));
    }

    /**
     * Store a newly created resource.
     */
    public function store(StoreBusRouteRequest $request): RedirectResponse
    {
        $this->busRouteService->create(
            $request->validated(),
            auth()->id()
        );

        return redirect()
            ->route('bus-routes.index')
            ->with('success', 'Bus Route created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusRoute $busRoute): View
    {
        $busOperators = $this->busRouteService->getBusOperators();

        return view('admin.bus-routes.edit', compact('busRoute', 'busOperators'));
    }

    /**
     * Update the specified resource.
     */
    public function update(
        UpdateBusRouteRequest $request,
        BusRoute $busRoute
    ): RedirectResponse {

        $this->busRouteService->update(
            $busRoute,
            $request->validated(),
            auth()->id()
        );

        return redirect()
            ->route('bus-routes.index')
            ->with('success', 'Bus Route updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(BusRoute $busRoute): RedirectResponse
    {
        $this->busRouteService->delete($busRoute);

        return redirect()
            ->route('bus-routes.index')
            ->with('success', 'Bus Route deleted successfully.');
    }
}
