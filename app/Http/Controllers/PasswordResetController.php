<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\User as Model;
use Illuminate\Support\Facades\Auth;

use View;
use Illuminate\Support\Facades\DB;

class PasswordResetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editPassword()
    {
        return view('auth.passwords.change');
    }

    public function updatePassword(Request $request)
    {
        $id = Auth::user()->id;
        $user = Model::find($id);

        if(!Hash::check($request->old_password, $user->password) ){
            return redirect()->route('passwordReset.editPassword')->with('error', 'Senha Antiga não Confere');
        }
        else{

            if($request->password != $request->password_confirmation){
                return redirect()->route('passwordReset.editPassword')->with('error', 'Senhas não Conferem');
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('home')->with('status', 'Senha Alterada com Sucesso');
           }
    }
}
