<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Rules\CanLoginAgain;
use App\Models\User;
use Carbon\Carbon;

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
     * Protected role
     */

    protected $isVoter = false;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return $this->isVoter ? 'identification' : 'username';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function login(Request $request)
    {
        if ($request->has('is_voter')) {
            $this->isVoter = true;
        }

        $this->validateFieldsLogin($request);

        if ($this->isVoter) {

            if (!$this->appAvailableForVote()) {
                return response()->json(["message" => 'El sistema se encuentra disponible en este momento'], 401);
            }

            if (!$this->validateIfUserVoted($request)) {
                return response()->json(["message" => 'Usted ya ejerció su derecho al voto, gracias por participar'], 401);
            }
        }



        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $user = Auth::user();
        $appname = env('app.name');
        $success['token'] =  $user->createToken($appname)->accessToken;
        $this->clearLoginAttempts($request);
        return response()->json(['success' => $success], 200);
    }

    /**
     * Get User Info API
     *
     * @return resource User
     */
    public function getInfo(Request $request)
    {
        return new UserResource($request->user());
    }


    public function logout(Request $request)
    {
        $logout = $request->user()->token()->revoke();
        return response()->json(['message' => 'Usuario fuera'], 200);
    }


    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = [
            $this->username() => $request->get($this->username()),
            'password' => $request->get('password'),
            'enabled' => 1
        ];
        return $this->guard()->attempt(
            $credentials,
            $request->filled('remember')
        );
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateIfUserVoted(Request $request)
    {
        $user =  User::where($this->username(), $request->get($this->username()))->whereEnabled(1)->first();
        if (!$user) return false;
        return true;
    }


     /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateFieldsLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Verifica si el sistema está disponible para votaciones
     *
     * @return void
     */
    public function appAvailableForVote()
    {

        return config('votes.enable-for-voters');


        $appAvailableFrom = Carbon::parse(config('votes.app-available-from'));
        $appAvailableUntil =Carbon::parse(config('votes.app-available-until'));
        $now = Carbon::now();

        dd($now);
       if($now->between($appAvailableFrom, $appAvailableUntil) ) {
           dd("entra");
           return true;
       }
       return false;
    }
}
