<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Models\City;
use App\Traits\LoggedUserTrait;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use LoggedUserTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logged_user = $this->userInfo();

        $cities = CityResource::collection(
            City::where('company_id', $logged_user->company_id)
                ->paginate(config('constants.pagination_rules.number_of_rows'))
        );

        return response()->json(['name' => 'Carlos']);

//        return inertia('Cities/Index', compact('cities'));
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
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
    }
}
