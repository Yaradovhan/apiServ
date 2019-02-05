<?php

namespace Modules\ClicksModule\Http\Controllers;

use App\Click;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class HomeController extends Controller
{
    public function index(Click $click)
    {
        $clicks = $click->sortable()->paginate(5);
        return view('clicksmodule::home.index',['clicks'=>$clicks]);
    }
}
