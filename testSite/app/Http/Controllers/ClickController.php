<?php

namespace App\Http\Controllers;

use App\Click;
use App\BadDomain;
use Faker\Provider\Internet;
use Illuminate\Http\Request;

class ClickController extends Controller
{

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        $click = Click::find($id);
        if (is_null($click)) {
            return response()->json(null, 404);
        }
        $response = Click::with('bad_domains')->findOrFail($id);

        return response()->json($response, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function trackLink(Request $request)
    {
        $p1 = isset($request->param1) ? $request->param1 : null;
        $p2 = isset($request->param2) ? $request->param2 : null;
        if (!$p1 || !$p2) {
            $response['error'] = 'Bad params';
            return response()->json($response, 200);
        }
        $res = Click::where('param1', base64_encode($p1))->where('param2', $p2)->get()->toArray();
        if (empty($res)) {
            $enc = $_SERVER['REMOTE_ADDR'] . "~" . $_SERVER['REQUEST_URI'];
            $res = Click::create([
                'click_id' => base64_encode($enc),
                'ua' => base64_encode($_SERVER['HTTP_USER_AGENT']),
//                'ip' => Internet::localIpv4(),
                'ip' => '192.168.0.0',
                'param1' => base64_encode($p1),
                'param2' => $p2,
            ]);
            $routeName = 'idSuccess';
            $resBad = BadDomain::where( 'name' , $res->ip)->get()->toArray();
            if(!empty($resBad)){
                $res->increment('bad_domain');
                $routeName = 'idError';
            }
        } else {
            $res = Click::find($res[0]['id']);
            $res->increment('error');
            $routeName = 'idError';
        }
        return redirect(route($routeName, ['click_id' => base64_encode($res->id)]));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function error($id)
    {
        $response = Click::with('bad_domains')->findOrFail(base64_decode($id));
        return response()->json($response, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function success($id)
    {
        $response = Click::find(base64_decode($id));
        return response()->json($response, 200);
    }

}
