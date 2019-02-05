<?php

namespace App\Http\Controllers;

use App\Click;


class HomeController extends Controller
{
    public function index(Click $click)
    {
        $clicks = $click->sortable()->paginate(5);
        return view('home.index',['clicks'=>$clicks]);
    }
}
