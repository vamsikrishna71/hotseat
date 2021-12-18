<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * To login with the company_id
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:employee')->except('logout');
    }

    public function showEmployeeLoginForm()
    {
        return view('auth.login', ['url' => 'mywork']);
    }

    public function employeeLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password'   => 'required|min:6',
        ]);

        if (Auth::guard('employee')->attempt(
            ['username' => $request->username, 'password' => $request->password],
            $request->get('remember'))) {

            return redirect()->intended('index');
        }
        return back()->withInput($request->only('username', 'remember'));
    }
}
