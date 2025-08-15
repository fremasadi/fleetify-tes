<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected UserRepository $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAllUsers()
    {
        return $this->repo->all();
    }

    public function createUser(UserDTO $dto)
    {
        return $this->repo->create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'role' => $dto->role
        ]);
    }

    public function updateUser(User $user, UserDTO $dto)
    {
        $data = [
            'name' => $dto->name,
            'email' => $dto->email,
            'role' => $dto->role
        ];

        if (!empty($dto->password)) {
            $data['password'] = Hash::make($dto->password);
        }

        return $this->repo->update($user, $data);
    }

    public function deleteUser(User $user)
    {
        return $this->repo->delete($user);
    }
}
