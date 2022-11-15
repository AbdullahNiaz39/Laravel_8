<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->session()->has('login')) {
            return redirect('admin/dashboard');

        } else {

            return view('admin.login');
        }

    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');
        $result = Admin::where(['email' => $email, 'password' => $password])->get();
        if (count($result) > 0) {
            $request->session()->put('login', true);
            $request->session()->put('checklogin', $email);
            return redirect('admin/dashboard');

        } else {
            $request->session()->flash('error', 'Please Enter Valid Email or Password');
            return redirect('admin');
        }

    }
    // public function updatepassword()
    // {
    //     $r = Admin::find(1);
    //     $r->password = Hash::make('ali');
    //     $r->save;
    // }

}
