<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Events\UserProfileImageProceed;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public static $API_PATH = '/api/v1';


    public function test_user_can_update_profile()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        UserProfile::factory()->create(['user_id' => $user->id]);

        $requestData = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'age' => $this->faker->numberBetween(18, 100)
        ];

        $response = $this->putJson(self::$API_PATH . '/profile', $requestData);
        $response->assertStatus(200);

        $this->assertDatabaseHas('user_profiles', $requestData);
        $this->assertEquals($requestData['first_name'], $user->profile->first_name);
    }


    public function test_it_dispatches_event_when_image_is_processed()
    {
        Event::fake();
        $request = new Request(['image' => 'https://example.com/image.jpg']);

        UserProfileImageProceed::dispatch($request);

        Event::assertDispatched(UserProfileImageProceed::class);
    }
}
