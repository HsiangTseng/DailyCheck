<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;


class LoginController extends Controller
{
    public function show()
    {
        return View::make('dashboard.frontend.login');
    }

    public function login()
    {
        $input = Input::all();

        $rules = ['account'=>'required|account',
                  'password'=>'required'
                  ];
    
        $validator = Validator::make($input, $rules);
    
        if ($validator->passes()) {
            $attempt = Auth::attempt([
                'email' => $input['email'],
                'password' => $input['password']
            ]);
    
            if ($attempt) {
                return Redirect::intended('post');
            }
    
            return Redirect::to('login')
                    ->withErrors(['fail'=>'Email or password is wrong!']);
        }
    
        //fails
        return Redirect::to('login')
                    ->withErrors($validator)
                    ->withInput(Input::except('password'));
    }
}
