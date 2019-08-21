<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\User as Model;
use Auth;

class ControllerUser extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('AcessControlAdmin');
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }
}
