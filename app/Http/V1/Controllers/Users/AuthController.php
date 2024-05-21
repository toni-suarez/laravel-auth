<?php
namespace App\Http\V1\Controllers\Users;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController
{
    /**
     * User Registration
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)->mixedCase()->numbers()->symbols()]
        ]);

        $user = User::create($fields);
        Auth::login($user);

        UserProfile::create(['user_id' => $user->id]);
        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $token
        ]);
    }

    /**
     * User Login
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
     * Password Reset-Token
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json
     */
    public function passwordResetToken(Request $request)
    {
         $request->validate(['email' => ['required', 'email']]);
         $user = User::where('email', 'LIKE', "%{$request->get('email')}%")->first();

         $tokenManager = Password::getRepository();

         if ($tokenManager->recentlyCreatedToken($user)) {
            return response()->json(['message' => Password::RESET_THROTTLED]);
         }

         $token = Password::createToken($user);

        return response()->json(['message' => $token]);
    }

    /**
     * Password Reset
     *
     * @param \Illuminate\Http\Request $request
     * @param string $token
     * @return void
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)->mixedCase()->numbers()->symbols()]
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)])
                    ->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );

        return response()->json(['message' => $status]);
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
}
