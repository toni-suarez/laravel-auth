<?php
namespace App\Http\V1\Controllers;

use Illuminate\Http\Request;

class UserProfileController
{
    /**
     * Show the current user
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json
     */
    public function index(Request $request)
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
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'maiden_name' => ['string', 'max:255'],
            'age' => ['integer', 'min:0'],
            'gender' => ['string', 'in:male,female'],
            'phone' => ['string', 'max:255'],
            'birth_date' => ['date'],
            'image' => ['url:http,https'],
            'height' => ['numeric', 'min:0', 'max:99999.99'],
            'weight' => ['numeric', 'min:0', 'max:99999.99'],
            'eye_color' => ['string', 'max:255'],
            'domain' => ['string', 'max:255'],
            'ip' => ['string'],
            'mac_address' => ['string'],
            'university' => ['string'],
            'ein' => ['string', 'max:255'],
            'ssn' => ['string', 'max:255'],
            'user_agent' => ['string'],
        ]);

        // @todo queue oder concurrent
        // Http::post('https://hkrexmrhido6bdtuu6rjahi5da0bfstk.lambda-url.eu-central-1.on.aws', [
        //     'image_url' => $request->image
        // ])->body();

        $user->profile()->update(array_merge(['ip' => $request->ip()], $fields));
        return response()->json(['message' => 'Your profile has been updated']);
    }
}
