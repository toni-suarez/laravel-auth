<?php
namespace App\Http\V1\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController
{
    /**
     * User Registeration
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()]
        ]);

        $user = User::create($fields);
        Auth::login($user);

        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }

    /**
     * User login
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($fields)) {
            return response()->json(['message'=> 'Email or password Invalid']);
        }

        $user = Auth::user();
        $token = $user->createToken('Personal Access Token')->plainTextToken;
        return response()->json(['token' => $token]);
    }

    /**
     * User Logout
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'You have been logged out!']);
    }

    /**
     * Show the current user
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json
     */
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Updates the profile
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $fields = $request->validate([
            'name' => ['string', 'min:3', 'max:255']
        ]);

        $user->update($fields);
        return response()->json(['message' => 'Your profile has been updated']);

    }
}
