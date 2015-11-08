<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Market;
use App\WinningCode;
use Illuminate\Support\Facades\Request as RequestData;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $redirectPath = '/dashboard';
    protected $redirectAfterLogout = '/home';


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'country' => $data['country'],
            'state' => $data['state'],
            'postal_code' => $data['postal_code'],
            'phone' => $data['phone']
        ]);
    }

    public function getLogin()
    {
        $loggedIn = false;
	$title = 'index';
	$markets = Market::orderBy('upvote', 'desc')->get();


        return view('auth.login', compact('title', 'markets', 'loggedIn'));
    }

    public function postLogin(Request $request) 
    {
        $loggedIn = false;
	$title = 'index';
	$markets = Market::orderBy('upvote', 'desc')->get();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');            
        } else {
            return view('auth.login', compact('title', 'markets', 'loggedIn'));
        }
    }

    public function getRegister() 
    {
        $loggedIn = false;
	$title = 'index';
	$markets = Market::orderBy('upvote', 'desc')->get();

        return view('auth.register', compact('title', 'markets', 'loggedIn'));    
    }

    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException (
                $request, $validator
            );
        }

        Auth::login($this->create($request->all()));

        return redirect('/');
    }
}
