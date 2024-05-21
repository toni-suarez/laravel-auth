<?php
namespace App\Http\V1\Controllers\Users;

use App\Logic\GPT;
use Elasticsearch;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Events\UserProfileImageProceed;

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


        UserProfileImageProceed::dispatch($request);

        $user->profile()->update($fields);
        return response()->json(['message' => 'Your profile has been updated']);
    }

    /**
     * Retrieve a personalized user description
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json
     */
    public function summary(Request $request)
    {
        if(!GPT::enabled()) {
            return response()->json(['message' => 'Please provide a API key']);
        }

        $cacheKey = "summary_{$request->user()->id}";
        $cacheTTL = now()->addHours(6);

        return Cache::remember($cacheKey,$cacheTTL, function () use($request) {
            $content = GPT::generate()
                ->input($request->user()->profile)
                ->limit(200)
                ->get()
                ->toString();

            return response()->json([
                'content' => $content,
                'input' => $request->user()
            ]);
        });
    }
}
