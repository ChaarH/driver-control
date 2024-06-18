<?php

namespace App\Http\Controllers;

use App\Http\Resources\DriverResource;
use App\Models\Driver;
use App\Traits\LoggedUserTrait;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use LoggedUserTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logged_user = $this->userInfo();

        $driversQuery = Driver::query()
            ->with('user')
            ->with(['runs' => function ($query) {
                $query->orderBy('id', 'desc');
            }])
            ->whereHas('user', function ($query) use ($logged_user) {
                $query->where('company_id', $logged_user->company_id);
            });

        $driversOfflineQuery   = clone $driversQuery;
        $driversAvailableQuery = clone $driversQuery;

        $driversOffline = $driversOfflineQuery
            ->where('online', false)
            ->get();

        $driversAvailable = $driversAvailableQuery
            ->where('online', true)
            ->orderBy('in_run')
            ->get();

        $drivers_offline   = DriverResource::collection($driversOffline);
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
