<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     * @return Response|RedirectResponse
     */
    public function store(Request $request): Response | RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'tel' => 'required|string|max:15|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'user_type' => 'admin',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function apiStore(Request $request): \Illuminate\Http\Response
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'tel' => 'required|string|max:15|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'deviceId' => 'required|uuid|exists:devices,device_uuid',
            'location' => 'required|string',
            'fcmToken' => 'required|string'
        ];

        $messages = [
            'unique' => 'The :attribute :input has already been taken.',
            'exists' => 'The :attribute :input does not exist.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Response($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'user_type' => 'customer',
            'fcmToken' => $request->fcmToken,
            'password' => Hash::make($request->password),
        ]);

        $device = Device::where('device_uuid',$request->deviceId)->first();
        $device->location = $request->location;
        $device->user_id = $user->id;
        $device->last_seen = Carbon::now();
        $device->save();

        $res = json_decode(json_encode($user), TRUE);
        $res['deviceId'] = $device->device_uuid;
        $token = $user->createToken('login');
        $res['token'] = $token->plainTextToken;
        return Response($res);
    }

    public function show(): \Illuminate\Http\Response
    {
        return Response(User::all());
    }
}
