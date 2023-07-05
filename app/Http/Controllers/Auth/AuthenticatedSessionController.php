<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Device;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

  /**
   * Handle an incoming authentication request.
   *
   * @param LoginRequest $request
   * @return RedirectResponse
   * @throws ValidationException
   */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * @throws ValidationException
     */
    public function apiStore(LoginRequest $request): \Illuminate\Http\Response
    {
        $request->authenticate();
        $user = $request->user();
        $user->fcmToken = $request->fcmToken;
        $user->save();
        $token = $user->createToken('login');

        $device = Device::where('user_id',$user->id)->first();

        $res = json_decode(json_encode($user), TRUE);
        $res['deviceId'] = $device->device_uuid;
        $res['token'] = $token->plainTextToken;
        return Response($res);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function apiDestroy(Request $request): \Illuminate\Http\Response
    {
        $request->user()->currentAccessToken()->delete();
        return Response(['token'=>null]);
    }
}
