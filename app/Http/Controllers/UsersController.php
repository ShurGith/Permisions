<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\UserUpdateRequest;
    use App\Models\User;

    class UsersController extends Controller
    {
        public function index()
        {
            return view('users.index', [
                'users' => User::all(),
            ]);
        }

        public function edit(User $user)
        {
            return view('users.edit', [
                'user' => $user
            ]);
        }

        public function update(UserUpdateRequest $request, User $user)
        {
            $user->update($request->all());
            return redirect()->route('users.index');
        }

        public function destroy(User $user)
        {
            $user->delete();

            return redirect()->route('users.index');
        }
    }
