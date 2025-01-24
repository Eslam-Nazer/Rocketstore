<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{

    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('home.index');
    }
}
