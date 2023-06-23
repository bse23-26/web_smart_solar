<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Fault;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Helpers\SendPushNotifications;

class FaultController extends Controller
{
    use SendPushNotifications;
    public function store(Request $request): Response
    {
        $request->validate(
            [
                'description' => 'required|string|max:255',
                'deviceId' => 'required|uuid|exists:devices,device_uuid',
                'time_occurred' => 'required|string'
            ],
            [
                'unique' => 'The :attribute :input has already been taken.',
                'exists' => 'The :attribute :input does not exist.'
            ]
        );

        $device = Device::where('device_uuid', $request->deviceId)->first();

        $fault = Fault::create([
            'device_id' => $device->id,
            'description' => $request->description,
            'time_occurred' => $request->time_occurred
        ]);

        $msg = "Fault report for device $device->device_uuid received.\n$fault->description";

        $this->sendPushNotification('devToken', 'Fault Report Received', $msg);
        return Response($fault);
    }
}
