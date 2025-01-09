<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\UserUpdateRequest;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;

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
            if (Auth::user()->id === $user->id) {
                abort(403, 'You cannot delete your self');  // or return back()->with('error', 'You cannot delete yourself');  // or return redirect()->route('users.index')->with('error', 'You cannot delete yourself');  // or return redirect()->back()->with('error', 'You cannot delete yourself');  // or return redirect()->route('dashboard')->with('error', 'You cannot delete yourself');  // or return redirect()->route('dashboard', ['error' => 'You cannot delete yourself']);  // or return redirect()->route('dashboard', ['message' => 'You cannot delete yourself', 'type' => 'error']);  // or return redirect()->route('dashboard')->withErrors(['error' => 'You cannot delete yourself']);  // or return redirect()->route('dashboard')->withInput()->withErrors(['error' => 'You cannot delete yourself']);  // or return redirect()->route('dashboard')->withInput()->with(['error' => '    You cannot delete yourself']); // or return redirect()->route('dashboard
                //
                //  ')
            }

            $user->delete();

            return redirect()->route('users.index');
        }
    }
