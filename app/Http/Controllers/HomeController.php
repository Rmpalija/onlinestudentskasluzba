<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $predmetis = \App\Predmeti::latest()->limit(5)->get(); 
        $ispitis = \App\Ispiti::latest()->limit(5)->get(); 
        $profesoris = \App\Profesori::latest()->limit(5)->get(); 

        return view('home', compact( 'predmetis', 'ispitis', 'profesoris' ));
    }
}
