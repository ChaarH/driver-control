<?php

namespace App\Http\Controllers;

use App\Http\Resources\DriverResource;
use App\Http\Resources\UserResource;
use App\Models\Driver;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class DriverController extends Controller
{
    public function index()
    {
        $driverQuery = Driver::query();

        $driverQuery = $this->applySearch($driverQuery, request('search'));

        // TODO
        // LISTAR USER-DRIVER WITH TRASHED

        $search  = request('search') ?? '';
        $users_drivers = DriverResource::collection(
            $driverQuery->with('user')
                ->paginate(config('constants.pagination_rules.number_of_rows'))
        );

        return inertia('Drivers/Index', compact('users_drivers', 'search'));
    }

    protected function applySearch(Builder $query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Drivers/Create');
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
    public function show(Driver $driver)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        $driver = Driver::with('user')
            ->where('id', $driver->id)
            ->first();

        $driver = DriverResource::make($driver);
        return inertia('Drivers/Edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
