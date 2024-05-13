<?php

namespace App\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserProfileImageProceed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request;

    /**
     * Create a new event instance.
     */
    public function __construct(Request $request)
    {
        //
    }

    public function handle()
    {
        $response = Http::post('https://hkrexmrhido6bdtuu6rjahi5da0bfstk.lambda-url.eu-central-1.on.aws', [
            'image_url' => $this->request->image
        ]);

        if ($response->failed()) {
            //
        }

        return $response->body();
    }
}
