<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChangeMuridPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if(!Auth::guard('admin')->user()->hasRole('admin')) return abort(404);
        
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ],
    ['password.confirmed' => 'Konfirmasi password salah']);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first());
        }   

        $user = User::find($request->user_id);
        $user->password = bcrypt($request->password);

        $user->save();

        return redirect()->route('murid.index')->with('success', 'Berhasil mengupdate password');

    }
}
