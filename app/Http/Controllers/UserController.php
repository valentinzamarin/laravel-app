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
}
