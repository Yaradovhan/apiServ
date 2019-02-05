<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BadDomain;

class BadDomainController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        return response()->json(Bad_domain::get(),200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        $bad = Bad_domain::find($id);
        if(is_null($bad)){
            return response()->json(null, 404);
        }
        $response = Bad_domain::with('clicks')->findOrFail($id);

        return response()->json($response, 200);
    }
}
