<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // redirect to register view
    public function registerView()
    {
        return view('register');
    }

    // register new user
    public function register(Request $request)
    {
        $registerData = $request->all();

        // data validation
        $validate = Validator::make($registerData, [
            'name' => 'required',
            'email' => 'required|email:rfc, dns|unique:users',
            'password' => 'required',
        ]);

        if($validate->fails()) {
            return redirect('/register')->with('error', $validate->errors()->first());
            // return response([
            //     'message' => $validate->errors()->first(),
            // ],400);
        }

        // encrypt password
        $registerData['password'] = bcrypt($registerData['password']);
        // create new user
        User::create($registerData);
        return redirect('/')->with('success','Registration Success');

        // return response([
        //     'message' => 'Registration Success',
        //     'data' => $registerData
        // ],200);
    }

    // redirect to login view
    public function loginView() 
    {
        return view('index');
    }

    // login
    public function login(Request $request)
    {
        $loginData = $request->only('email', 'password');

        // data validation
        $validate = Validator::make($loginData, [
            'email' => 'required|email:rfc, dns',
            'password' => 'required',
        ]);

        if($validate->fails()) {
            return redirect('/')->with('error', $validate->errors()->first());
            // return response([
            //     'message' => $validate->errors()->first(),
            // ],400);
        }

        // login credential not equal to database
        if(!auth()->attempt($loginData)) {
            return redirect('/')->with('error', 'Invalid credentials');
        }

        $user = Auth::user();
        // Generate JWT Token
        $token = Auth::user()->createToken('authToken')->plainTextToken;
        return view('dashboard', compact('user', 'token'))->with('success','Login Success');
        // return response([
        //     'message' => 'Login Success',
        //     'data' => $user
        // ],200);
    }

    // logout
    public function logout()
    {
        $user = Auth::guard('web')->logout();

        return view('index')->with('success','Logout');
        // return response([
        //     'message' => 'Logout Success',
        // ],200);
    }
}
