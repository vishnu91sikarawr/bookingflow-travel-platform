<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bus\StoreBusRequest;
use App\Http\Requests\Bus\UpdateBusRequest;
use App\Models\Bus;
use App\Services\BusService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BusController extends Controller
{
    public function __construct(
        private readonly BusService $busService,
    ) {}

    /**
     * Display a listing of bus operators.
     */
    public function index(Request $request): View
    {
        $bus = $this->busService->paginate(
            $request->query('search')
        );

        return view('admin.buses.index', compact('bus'));
    }

    /**
     * Show the form for creating a new bus operator.
     */
    public function create()
    {
        $busOperators = $this->busService->getBusOperators();

        return view('admin.buses.create', compact('busOperators'));
    }

    /**
     * Store a newly created bus operator.
     */
    public function store(StoreBusRequest $request): RedirectResponse
    {
        $this->busService->create(
            array_merge($request->validated(), [
                'status' => $request->boolean('status'),
            ]),
            $request->user()->id
        );

        return redirect()
            ->route('buses.index')
            ->with('success', 'Bus created successfully.');
    }

    /**
     * Show the form for editing a bus operator.
     */
    public function edit(Bus $bus)
    {
        $busOperators = $this->busService->getBusOperators();

        return view('admin.buses.edit', compact('bus', 'busOperators'));
    }

    /**
     * Update the specified bus operator.
     */
    public function update(UpdateBusRequest $request, Bus $Bus): RedirectResponse
    {
        $this->busService->update(
            $Bus,
            array_merge($request->validated(), [
                'status' => $request->boolean('status'),
            ]),
            $request->user()->id
        );

        return redirect()
            ->route('buses.index')
            ->with('success', 'Bus updated successfully.');
    }

    /**
     * Remove the specified bus operator.
     */
    public function destroy(Bus $Bus): RedirectResponse
    {
        $this->busService->delete($Bus);

        return redirect()
            ->route('buses.index')
            ->with('success', 'Bus deleted successfully.');
    }
}
