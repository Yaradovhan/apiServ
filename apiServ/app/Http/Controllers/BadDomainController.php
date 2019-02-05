<?php

namespace App\Http\Controllers;

use App\Bad_domain;
use Illuminate\Http\Request;

class BadDomainController extends Controller
{
    public function index()
    {
        return response()->json(Bad_domain::get(),200);
    }

    public function show($id)
    {
        $bad = Bad_domain::find($id);
        if(is_null($bad)){
            return response()->json(null, 404);
        }

        $response = Bad_domain::with('clicks')->findOrFail($id);
//        return response()->json(Bad_domain::find($id),200);
//        $bad_dom  = Bad_domain::find($id);
//        $clicks = $bad_dom->clicks;
//        foreach ($clicks as $val) {
//            dd($val);
//        }
        return response()->json($response, 200);
    }
}
