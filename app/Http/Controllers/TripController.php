<?php

namespace App\Http\Controllers;

use App\Http\Resources\DriverResource;
use App\Http\Resources\ReasonWithdrawalResource;
use App\Http\Resources\TripResource;
use App\Models\Driver;
use App\Models\ReasonWithdrawal;
use App\Models\Trip;
use App\Traits\LoggedUserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    use LoggedUserTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logged_user = Auth::user();

        $trips = Trip::with('driver')
            ->where('company_id', $logged_user->company_id)
            ->orderBy('id', 'desc')
            ->paginate(config('constants.pagination_rules.number_of_rows'));

        $trips = TripResource::collection($trips);

        return inertia('Trips/Index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $logged_user = $this->userInfo();

        $reasons_for_withdrawal = ReasonWithdrawalResource::collection(
            ReasonWithdrawal::with('company')
                ->whereHas('company', function ($query) use ($logged_user) {
                    $query->where('id', $logged_user->company_id);
                })
                ->get()
        );

        // TODO
        // Selecionar somente os motorias online e disponíveis
        // Adicionar tempo de ociosidade na visualização

        $drivers = DriverResource::collection(
            Driver::with('user')
                ->whereHas('user', function ($query) use ($logged_user) {
                    $query->where('company_id', $logged_user->company_id)
                        ->orderBy('name');
                })
                    ->where('online', true)
                    ->where('in_trip', false)
                    ->get()
        );

        return inertia('Trips/Create', compact('reasons_for_withdrawal', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
