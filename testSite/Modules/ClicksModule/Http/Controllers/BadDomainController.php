<?php

namespace Modules\ClicksModule\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\BadDomain;

class BadDomainController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        return response()->json(BadDomain::get(), 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        $bad = BadDomain::find($id);
        if (is_null($bad)) {
            return response()->json(null, 404);
        }
        $response = BadDomain::with('clicks')->findOrFail($id);

        return response()->json($response, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    /*
        {
	        "name":"value of name"
        }
     */
    public function create(Request $request)
    {
        $domain = BadDomain::create($request->all());
        return response()->json($domain, 201);
    }

    /**
     * @param Request $request
     * @param BadDomain $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, BadDomain $id)
    {
        $id->delete();
        return response()->json(null, 204);
    }

    /**
     * @param Request $request
     * @param BadDomain $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, BadDomain $id)
    {
        $id->update($request->all());
        return response()->json($id, 200);
    }
}
