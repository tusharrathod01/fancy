<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserActivity;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Stevebauman\Location\Facades\Location;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('name', $request->name)->first();
        if ($user) {
            $data = [
                'email' => $user->email,
                'password' => $request->password
            ];
            if (Auth::attempt($data)) {
                $ip = request()->ip();
                $lotion = Location::get($ip);
                $activity = new UserActivity();
                $activity->user_id = $user->id;
                $activity->ip = $ip;
                if ($lotion) {
                    $activity->location =  $lotion->countryName;
                }
                $activity->save();
                return redirect()->back();
            } else {
                return redirect()->back()->withInput($request->only('name'));
            }
        } else {
            return redirect()->back()->withInput($request->only('name'));
        }
    }
}
