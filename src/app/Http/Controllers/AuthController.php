<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Fortify;
use App\Http\Providers\FortifyServiceProvider;
use Laravel\Fortify\Fortify as FortifyFortify;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function home()
    {
        return view('admin');
    }

}
