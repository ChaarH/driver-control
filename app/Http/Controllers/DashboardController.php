<?php

namespace App\Http\Controllers;

use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $driversQuery = Driver::query()->with('user');

        $driversOfflineQuery   = clone $driversQuery;
        $driversAvailableQuery = clone $driversQuery;
        $driversBusyQyery      = clone $driversQuery;

        $driversOffline = $driversOfflineQuery
            ->where('online', false)
            ->get();

        $driverBusy = $driversBusyQyery
            ->where('online', true)
            ->where('in_run', true)
            ->get();

        $driversAvailable = $driversAvailableQuery
            ->where('online', true)
            ->get();

        $drivers_offline   = DriverResource::collection($driversOffline);
        $drivers_busy      = DriverResource::collection($driverBusy);
        $drivers_available = DriverResource::collection($driversAvailable);

        return inertia('Dashboard', compact('drivers_available', 'drivers_offline'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}