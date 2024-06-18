<?php

namespace App\Http\Controllers;

use App\Http\Resources\RunResource;
use App\Models\Run;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logged_user = Auth::user();

        $runs = Run::with('driver')
            ->where('company_id', $logged_user->company_id)
            ->latest()
            ->paginate(config('constants.pagination_rules.number_of_rows'));

        $runs = RunResource::collection($runs);

        return inertia('Runs/Index', compact('runs'));
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
    public function show(Run $run)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Run $run)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Run $run)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Run $run)
    {
        //
    }
}
