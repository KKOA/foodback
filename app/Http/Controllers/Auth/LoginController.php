<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
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
     * @var string $redirectTo
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

    public function redirectTo() :string
    {
        if ($this->request->has('previous')) {
            // $this->redirectTo = $this->request->get('previous');
            $newUrl = $this->request->get('previous');
        }
        //dd($newUrl, $this->redirectTo);
        return ($newUrl ?? $this->redirectTo);

    }

        /**
     * Log the user out of the application. User is redirect back to previous page, 
     * if the page is not accessible by guest then user is sent to login page.
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function logout(Request $request) :RedirectResponse
    {
        $this->guard()->logout();
        $request->session()->invalidate();
//		dd(redirect($request->get('previous')));
        return redirect($request->get('previous'));
    }

}
