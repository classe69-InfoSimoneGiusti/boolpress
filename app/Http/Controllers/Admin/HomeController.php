<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {

        //$user = Auth::user(); // ritorna un instanza della classe User dell'utente correntemente loggato

        //dd($user);

        return view('admin.home');

    }
}
