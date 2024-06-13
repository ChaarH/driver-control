<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    public function index()
    {
        $userQuery = User::query();

        $userQuery = $this->applySearch($userQuery, request('search'));

        $search = request('search') ?? '';

        $users = UserResource::collection(
            $userQuery->whereIn('role_id', [
                Role::ROLES['administrator'],
                Role::ROLES['operator']
            ])
                ->withTrashed()
                ->paginate(config('constants.pagination_rules.number_of_rows'))
        );

        return inertia('Users/Index', compact('users', 'search'));
    }

    protected function applySearch(Builder $query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }

    public function create()
    {
        $roles = RoleResource::collection(Role::all());

        return inertia('Users/Create', compact('roles'));
    }

    public function store(UserStoreRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('users.index');
    }
}
