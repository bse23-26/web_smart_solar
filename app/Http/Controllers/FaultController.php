<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Fault;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Helpers\SendPushNotifications;
use Illuminate\Support\Facades\Log;

class FaultController extends Controller
{
    use SendPushNotifications;
    public function store(Request $request): Response
    {
        $request->validate(
            [
                'description' => 'required|string|max:255',
                'subject' => 'required|string|max:255'
            ]
        );

        $user = $request->user();
        $device = Device::where('user_id', $user->id)->first();

        $fault = Fault::create([
            'device_id' => $device->id,
						'subject' => $request->subject,
            'description' => $request->description,
        ]);

        $SERVER_API_KEY = env('FCM_SERVER_KEY');

        $subject = "Fault report for device $device->device_uuid received.";
        $desc = "subject: ".$fault->subject."\ndescription: ".$fault->description;
        $this->sendNotification($subject, $desc, [$user->fcmToken]);
        return Response(["message"=>"Fault report sent successfully"]);
    }
}
