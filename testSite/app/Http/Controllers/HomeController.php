<?php

namespace App\Http\Controllers;

use Modules\ClicksModule\Model\Click;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Click $click)
    {
        $clicks = $click->sortable()->paginate(5);
        return view('home.index',['clicks'=>$clicks]);
    }
}
