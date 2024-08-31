<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class UserController extends Controller {
    public function register( Request $request ) {
        $userRegisterFields = $request->validate([
            'name'     => [ 'required', 'max:50', Rule::unique( 'users', 'name' ) ],
            'email'    => [ 'required', 'email', Rule::unique( 'users', 'email' ) ],
            'password' =>  [ 'required', 'min:6' ],
        ]);

        $userRegisterFields['password'] = bcrypt( $userRegisterFields['password' ] );
        $user = User::create( $userRegisterFields );
        auth()->login( $user );

        return redirect( '/' );
    }

    public function login( Request $request ) {
        $userLogin = $request->validate([
            'login_name'     => [ 'required' ],
            'login_password' => [ 'required' ],
        ]);

        if (auth()->attempt([
            'name'     => $userLogin['login_name'],
            'password' => $userLogin['login_password']
        ])) {
            $request->session()->regenerate();
        }


        return redirect( '/' );
    }

    public function logout() {
        auth()->logout();
        return redirect( '/' );
    }
}
