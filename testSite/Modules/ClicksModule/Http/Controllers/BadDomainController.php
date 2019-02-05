<?php

namespace Modules\ClicksModule\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ClicksModule\Model\BadDomain;

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
            return response()->json(null, 200);
        }
        $response = BadDomain::with('clicks')->findOrFail($id);

        return response()->json($response, 200);
    }

    /**
     * "name":"value of name"
     * @param Request $request
     * @return string
     */

    public function create(Request $request)
    {
        try {
            $domain = BadDomain::create($request->all());
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return response()->json($domain, 201);
    }

    /**
     * @param Request $request
     * @param BadDomain $id
     * @return string
     * @throws \Exception
     */
    public function destroy(Request $request, BadDomain $id)
    {
        try {
            $id->delete();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return response()->json(null, 204);
    }

    /**
     * @param Request $request
     * @param BadDomain $id
     * @return string
     */
    public function update(Request $request, BadDomain $id)
    {
        try {
            $id->update($request->all());
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return response()->json($id, 200);
    }
}
