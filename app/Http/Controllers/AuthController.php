<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Session;
use Auth;
use App\User;
class AuthController extends Controller {
    public function showLoginForm(Request $req){
        $loggedIn = Auth::check();
        return $loggedIn ? redirect('/') : view('login');
    }
    public function showRegisterForm(Request $req){
        return view('register');
    }
    public function login (Request $req) {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];
 
        $messages = [
            'email.required'        => 'Please Fill The Email',
            'email.email'           => 'Email is not valid',
            'password.required'     => 'Please Fill The Email',
            'password.string'       => 'Password Must in string'
        ];

        $validator = Validator::make($req->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput($req->all);
        }
 
        $credentials = [
            'email'     => $req->input('email'),
            'password'  => $req->input('password'),
        ];
        $authCookie = $req->input('remember-me') == 'on' ? true : false;
        $loggedIn = Auth::attempt($credentials , $authCookie);
        return $loggedIn ? 
            redirect('/') : 
            redirect('/login')
                ->withErrors(['error' => 'Email atau password Salah!']);
    }
    public function logout(Request $req) {
        Auth::logout();
        return redirect('/');
    }
    public function register( Request $req) {
        $rules = [
            'name'                  => 'required|min:5',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|alpha_num',
            'confirm-password'      => 'required|same:password',
        ];
 
        $messages = [
            'name.required'         => 'Please Fill The Name123s',
            'name.min'              => 'name must be more than 4',
            'email.required'        => 'Please Fill The Email',
            'email.email'           => 'Email is not valid',
            'email.unique'          => 'please use diffrent email',
            'password.min'          => 'must be more than 5 Password',
            'password.alpha_num'    => 'Password can only contain number and alphabet',
            'confirm-password.same' => 'Password Confirmation should match the Password',
        ];
        $validator = Validator::make($req->all(), $rules, $messages);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput($req->all);
 
        $user = new User;
        $user->name = ucwords(strtolower($req->name));
        $user->email = strtolower($req->email);
        $user->password = Hash::make($req->password);
        $savedUser = $user->save();
        
        if($savedUser){
            return redirect('/login');
        } else {
            return redirect('/register')->withErrors(['error' => 'Failed to register, please try again later']);
        }
    }
}
