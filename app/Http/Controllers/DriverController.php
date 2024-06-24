<?php

namespace App\Http\Controllers;

use App\Http\Resources\DriverResource;
use App\Http\Resources\UserResource;
use App\Models\Driver;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use App\Traits\AvatarGeneratorTrait;
use App\Traits\FileUploadTrait;
use App\Traits\LoggedUserTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DriverController extends Controller
{
    use LoggedUserTrait;
    use AvatarGeneratorTrait;
    use FileUploadTrait;

    public function index()
    {
        $driverQuery = Driver::query();

        $driverQuery = $this->applySearch($driverQuery, request('search'));

        // TODO
        // LISTAR USER-DRIVER WITH TRASHED
        $logged_user = $this->userInfo();

        $search  = request('search') ?? '';

        $users_drivers = DriverResource::collection(
            $driverQuery->with('user')
                ->whereHas('user', function ($query) use ($logged_user) {
                    $query->where('company_id', $logged_user->company_id);
                })
                ->orderBy('id', 'desc')
                ->paginate(config('constants.pagination_rules.number_of_rows'))
        );

        return inertia('Drivers/Index', compact('users_drivers', 'search'));
    }

    protected function applySearch(Builder $query, $search)
    {
        $query = $query->with('user');


        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }

    public function calculateIdleTime($driver_id)
    {
        $lastRun = Trip::getLastRunFromDriver($driver_id);

        return Carbon::now()
            ->subMinutes($lastRun->ended_at)
            ->diffInMinutes(Carbon::now());
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
        $logged_user = $this->userInfo();

        $data['name']       = $request->name;
        $data['email']      = $request->email;
        $data['role_id']    = Role::ROLES['driver'];
        $data['company_id'] = $logged_user->company_id;
        $data['password']   = Hash::make(Str::random(6));

        if ($request->file('avatar')) {
            $data['avatar'] = $this->saveFiles($request->file('avatar'));
        } else {
            $data['avatar'] = $this->generateLink($request->name);
        }

        $user = User::create($data);

        if ($user) {
            Driver::create([
                'user_id'    => $user->id,
                'run_price'  => $request->run_price
                    ?? Settings::where('slug', 'run_price')
                        ->first()
                        ->pluck('value'),
                'pix'        => $request->pix,
                'car_brand'  => $request->car_brand
            ]);
        }

        return redirect()->route('drivers.index');
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
