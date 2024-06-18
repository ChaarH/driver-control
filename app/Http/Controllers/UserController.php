<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Traits\AvatarGeneratorTrait;
use App\Traits\LoggedUserTrait;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AvatarGeneratorTrait;
    use LoggedUserTrait;

    public function index()
    {
        $userQuery = User::query();

        $userQuery = $this->applySearch($userQuery, request('search'));

        $search = request('search') ?? '';

        $patterQuery =  $userQuery
            ->company()
            ->whereIn('role_id', [
                Role::ROLES['administrator'],
                Role::ROLES['operator']
            ]);

        $active_users = UserResource::collection(
            $patterQuery
                ->latest()
                ->paginate(config('constants.pagination_rules.number_of_rows'))
        );

        $inactive_users = UserResource::collection(
            $patterQuery
                ->latest()
                ->onlyTrashed()
                ->paginate(config('constants.pagination_rules.number_of_rows'))
        );

        return inertia('Users/Index', compact('active_users', 'inactive_users', 'search'));
    }

    protected function applySearch(Builder $query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }

    public function create()
    {
        $roles = Role::getOnlyOperationalRoles();

        return inertia('Users/Create', compact('roles'));
    }

    public function store(UserStoreRequest $request)
    {
        $logged_user = $this->userInfo();

        $data = $request->validated();

        $data['company_id'] = $logged_user->company_id;
        $data['password'] = Hash::make($data['password']);
        $data['avatar'] = $this->generateLink($data['name']);

        User::create($data);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $roles = Role::getOnlyOperationalRoles();

        $user = User::find($id);

        return inertia('Users/Edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->role_id = $request->role_id;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
