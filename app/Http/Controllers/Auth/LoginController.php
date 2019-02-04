<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/restaurants';

    /**
     * @param Request $request
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');

        $this->request = $request;
    }

    /**
     * Redirect users to the appropriate page after successful login.
     * 
     * @return string
     */

    public function redirectTo()
    {
        $newUrl = null;
        if ($this->request->has('previous')) {
            // $this->redirectTo = $this->request->get('previous');
            $newUrl = $this->request->get('previous');
        }
        //dd($newUrl, $this->redirectTo);
        return $newUrl ?? $this->redirectTo;

    }

        /**
     * Log the user out of the application. User is redirect back to previous page, 
     * if the page is not accessibile by guest then user is sent to login page.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect($request->get('previous'));
    }

}
