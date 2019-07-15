<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;




/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string $redirectTo
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest');
        $this->request = $request;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) :\Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'first_name'    => 'required|string|min:3|max:255',
	        'last_name'     => 'required|string|min:3|max:255',
//	        'username'      => 'nullable|string|min:3|max:255|unique:users',
	        'username'      => 'required|string|min:3|max:255|unique:users',
	        'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) :User
    {
        return User::create([
            'first_name' => $data['first_name'],
	        'last_name' => $data['last_name'],
//	        'username' => $data['username'] != null ? $data['username'] : strtolower($data['first_name'].$data['last_name']),
	        'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Redirect users to the appropriate page after successful registering an account.
     * 
     * @return string
     */

    public function redirectTo() :string
    {
        
        if ($this->request->has('previous')) {
            // $this->redirectTo = $this->request->get('previous');
            $newUrl = $this->request->get('previous');
        }

        return $newUrl ?? $this->redirectTo;
    }
}
