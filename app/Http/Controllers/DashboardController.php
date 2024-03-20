<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    // redirect to dashboard view
    public function index()
    {
        return view('dashboard');
    }

    // redirect to editPassword view
    public function edit($id)
    {
        $user = User::find($id);
        
        return view('editPassword', compact('user'));
    }

    // update password in database
    public function update(Request $request, $id)
    {
        $passwordData = $request->all();

        // data validation
        $validate = Validator::make($passwordData, [
            'password' => 'required'
        ]);

        if($validate->fails()){
            return redirect('/editPassword')->with('error', $validate->errors()->first());
            // return response([
            //     'message' => $validate->errors()->first(),
            // ],400);
        }

        $user = User::find($id);
        // encrypt password
        $passwordData['password'] = bcrypt($passwordData['password']);
        $user->update($passwordData);
        return redirect('/dashboard');
        // return response([
        //     'message' => 'Update Password Success',
        // ],200);
    }
}
