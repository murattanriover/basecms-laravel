<?php namespace App\Http\Controllers\Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Register disabled
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return redirect('auth/login');die;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        return redirect('auth/login');die;
    }

    /**
     * Show Login Form
     *
     * @return Response
     */
    public function getLogin()
    {
        return view('cms.auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  Request  $request
     * @return Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request,['email' => 'required|email', 'password' => 'required']);
        $request->offsetSet('status',1);
        if ($this->auth->attempt($request->only('email', 'password','status'))){
            return redirect('/dashboard');
        }else{
            return redirect('/auth/login')->withErrors(['email' => trans('app.email_or_password_incorrect')]);
        }
    }
}