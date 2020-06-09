<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SpaController extends Controller
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
    
    public function index()
    {
        return view('admins.index');
    }
}
