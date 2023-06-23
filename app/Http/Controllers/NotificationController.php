<?php
namespace App\Http\Controllers;

//use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Kreait\Firebase\Factory;
//use Kreait\Firebase\Messaging\CloudMessage;
//use Kreait\Firebase\Messaging\Notification;

class NotificationController extends Controller
{
    public function store(Request $request): Response
    {
        $user = $request->user();
        $user->device_token=$request->device_token;
        $user->save();
        return Response('successful');
    }

    public function send(Request $request): RedirectResponse
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = env('FCM_SERVER_KEY');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return back()->with('success', 'Notification send successfully.');
    }
}
