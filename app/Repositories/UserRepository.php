<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    use ResponseAPI;

    /**
     * Implement the register method of UserInterface
     *
     */
    public function register(UserRequest $request)
    {
        try {
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
            return $this->success("User created", 201);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Implement the update method of UserInterface
     *
     */
    public function update(UserRequest $request, $user)
    {
        try {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->save();
            return $this->success("User updated", 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
