<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
	public function login(Request $request) {

		$input = $request->all();
		if (Auth::attempt(array('email' =>$input['email'], 'password' => $input['password']))) {


			$request->session()->flash('success', 'Logged in successfully!');
			return redirect()->route('admin.dashboard');
		} else {
			session()->flash('danger', 'Username and Password is not matched!');
			return redirect()->back();
		}
	}

	public function logout() {
		Session::flush ();
		Auth::logout ();
		return Redirect::back ();
	}
}
