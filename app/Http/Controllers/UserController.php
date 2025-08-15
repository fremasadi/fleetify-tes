<?php

namespace App\Http\Controllers;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

use App\Services\UserService;

class UserController extends Controller
{
    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $users = $this->service->getAllUsers();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $this->service->createUser(new UserDTO($request->validated()));
        return redirect()->route('users.index')->with('Berhasil', 'User Berhasil Dibuat.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->service->updateUser($user, new UserDTO($request->validated()));
        return redirect()->route('users.index')->with('Berhasil', 'User Berhasil DiUpdate.');
    }

    public function destroy(User $user)
    {
        $this->service->deleteUser($user);
        return redirect()->route('users.index')->with('Berhasil', 'User Berhasil Dihapus.');
    }
}
