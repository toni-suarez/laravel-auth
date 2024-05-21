<?php
namespace App\Http\V1\Controllers\Users;

use App\Models\UserProfile;
use Illuminate\Http\Request;;
use Illuminate\Validation\Rules\Password as PasswordRule;

class UserController
{
    /**
     * Retrieve all user profiles
     *
     * @return \Illuminate\Http\Resources\Json
     */
    public function index()
    {
        return UserProfile::with(['hair', 'company', 'bank', 'crypto'])
            ->paginate();
    }


    /**
     * Retrieve current user
     *
     * @return \Illuminate\Http\Resources\Json
     */
    public function show(Request $request)
    {
        return $request->user()->with('profile')->get();
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'password' => ['required', PasswordRule::min(8)->mixedCase()->numbers()->symbols()->uncompromised()]
        ]);


        $user->update($fields);
        return response()->json(['message' => 'Your profile has been updated']);
    }
}
