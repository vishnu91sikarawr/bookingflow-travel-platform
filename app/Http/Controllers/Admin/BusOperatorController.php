<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusOperator\StoreBusOperatorRequest;
use App\Http\Requests\BusOperator\UpdateBusOperatorRequest;
use App\Models\BusOperator;
use App\Services\BusOperatorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BusOperatorController extends Controller
{
    public function __construct(
        private readonly BusOperatorService $busOperatorService,
    ) {}

    /**
     * Display a listing of bus operators.
     */
    public function index(Request $request): View
    {
        $busOperators = $this->busOperatorService->paginate(
            $request->query('search')
        );

        return view('admin.bus-operators.index', compact('busOperators'));
    }

    /**
     * Show the form for creating a new bus operator.
     */
    public function create(): View
    {
        return view('admin.bus-operators.create');
    }

    /**
     * Store a newly created bus operator.
     */
    public function store(StoreBusOperatorRequest $request): RedirectResponse
    {
        $this->busOperatorService->create(
            array_merge($request->validated(), [
                'status' => $request->boolean('status'),
            ]),
            $request->user()->id
        );

        return redirect()
            ->route('bus-operators.index')
            ->with('success', 'Bus operator created successfully.');
    }

    /**
     * Show the form for editing a bus operator.
     */
    public function edit(BusOperator $busOperator): View
    {
        return view('admin.bus-operators.edit', compact('busOperator'));
    }

    /**
     * Update the specified bus operator.
     */
    public function update(UpdateBusOperatorRequest $request, BusOperator $busOperator): RedirectResponse
    {
        $this->busOperatorService->update(
            $busOperator,
            array_merge($request->validated(), [
                'status' => $request->boolean('status'),
            ]),
            $request->user()->id
        );

        return redirect()
            ->route('bus-operators.index')
            ->with('success', 'Bus operator updated successfully.');
    }

    /**
     * Remove the specified bus operator.
     */
    public function destroy(BusOperator $busOperator): RedirectResponse
    {
        $this->busOperatorService->delete($busOperator);

        return redirect()
            ->route('bus-operators.index')
            ->with('success', 'Bus operator deleted successfully.');
    }
}
