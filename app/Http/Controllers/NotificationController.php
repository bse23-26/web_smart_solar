<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Helpers\SendPushNotifications;

class NotificationController extends Controller
{
    use SendPushNotifications;
    public function store(Request $request): Response
    {
        $user = $request->user();
        $user->device_token=$request->device_token;
        $user->save();
        return Response('successful');
    }

    public function send(Request $request): Response
    {
        $request->validate([
            'title'=>'required|string',
            'body'=>'required|string'
        ]);

        $firebaseToken = User::whereNotNull('fcmToken')->pluck('fcmToken')->all();

        $this->sendNotifiication($request->title, $request->body, $firebaseToken);

        return Response(['success' => 'Notification sent successfully.']);
    }

    public function sendToClient(Request $request): RedirectResponse
    {
        $request->validate([
            'subject'=>'required|string',
            'description'=>'required|string'
        ]);

        $firebaseToken = User::find($request->id)->fcmToken;

        $this->sendNotification($request->subject, $request->description, [$firebaseToken]);
        return to_route('notify.withMessage',['id'=>$request->id, 'message'=>'Notification sent successfully.']);
    }

}
