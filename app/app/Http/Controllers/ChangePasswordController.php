<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('changepasswords.changePassword');
    }

    public function index_any()
    {
          $users = User::all();
          return view('changepasswords.cambiaPassword',['users'=>$users]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return view('alerta')
          ->with('mensaje','Password actualizado');
    }

    public function store_any(Request $request)
    {

      $request->validate([
          'userid' => ['required'],
          'new_password' => ['required'],
          'new_confirm_password' => ['same:new_password'],
      ]);

        User::find($request->userid)->update(['password'=> Hash::make($request->new_password)]);
        return view('alerta')
          ->with('mensaje','Password actualizado');
    }
}
