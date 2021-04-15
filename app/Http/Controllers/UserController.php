<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register']]);
    }

    /**
     * Create a new user
     *
     * @param \Illuminate\Http\JsonResponse $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|ends_with_tld|unique:users|max:255',
            'password' => 'required|case_diff|numbers|letters|symbols|max:255|min:8',
            'role' => 'required|in:admin,user',
        ],
            [
                'first_name.required' => 'Enter First Name',
                'first_name.max' => 'Maximum 255 Characters',
                'last_name.required' => 'Enter Last Name',
                'last_name.max' => 'Maximum 255 Characters',
                'email.required' => 'Enter Email Address',
                'email.email' => 'Invalid Email Address',
                'email.ends_with_tld' => 'Invalid Email Address',
                'email.unique' => 'Email Already Exists',
                'email.max' => 'Maximum 255 Characters',
                'password.required' => 'Enter New Password',
                'password.min' => 'Use 8 characters or more',
                'password.max' => 'Maximum 255 Characters',
                'password.case_diff' => 'Password will must have atleast 1 uppercase and 1 lower case character',
                'password.numbers' => 'Password will must have atleast 1 number',
                'password.letters' => 'Password will must have atleast 1 letter',
                'password.symbols' => 'Password will must have atleast 1 special character',
                'role.required' => 'Enter Role',
                'role.in' => 'Role must be admin or user',
            ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json(['user' => $user], 200);
    }

    /**
     * Update first name and last name
     *
     * @param \Illuminate\Http\JsonResponse $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateName(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
        ],
            [
                'first_name.required' => 'Enter First Name',
                'first_name.max' => 'Maximum 255 Characters',
                'last_name.required' => 'Enter Last Name',
                'last_name.max' => 'Maximum 255 Characters',
            ]);

        $user = auth()->user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();

        return response()->json(['user' => $user], 200);
    }
}
