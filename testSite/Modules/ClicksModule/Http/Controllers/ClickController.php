<?php

namespace Modules\ClicksModule\Http\Controllers;


use Modules\ClicksModule\Model\Click;
use Modules\ClicksModule\Model\BadDomain;
use Faker\Provider\Internet;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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
        $response = Click::with('badDomains')->findOrFail($id);

        return response()->json($response, 200);
    }

    /**
     * @param Request $request
     * @return string
     */

    public function trackLink(Request $request)
    {
        $p1 = isset($request->param1) ? $request->param1 : null;
        $p2 = isset($request->param2) ? $request->param2 : null;
        if (!$p1 || !$p2) {
            $response['error'] = 'bad parameters';

            return response()->json($response, 200);
        }
        $res = Click::where('param1', base64_encode($p1))->where('param2', $p2)->get()->toArray();
        if (!$res) {
            $enc = request()->server('REMOTE_ADDR') . "~" . request()->server('REQUEST_URI');
            try {
                $res = Click::create([
                    'click_id' => base64_encode($enc),
                    'ua' => base64_encode($_SERVER['HTTP_USER_AGENT']),
                    'ip' => Internet::localIpv4(),
                    'param1' => base64_encode($p1),
                    'param2' => $p2,
                ]);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
            $routeName = 'idSuccess';
            try {
                $resBad = BadDomain::where('name', $res->ip)->get()->toArray();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
            if ($resBad) {
                $res->increment('badDomain');
                $routeName = 'idError';
            }
        } else {
            try{
                $res = Click::find(reset($res)['id']);
            } catch (\Exception $e){
                return $e->getMessage();
            }
            $res->increment('error');
            $routeName = 'idError';
        }

        return redirect(route($routeName, ['click_id' => base64_encode($res->id)]));
    }

    /**
     * @param $id
     * @return string
     */

    public function error($id)
    {
        try {
            $response = Click::with('badDomains')->findOrFail(base64_decode($id));
        } catch (\Exception $e) {

            return $e->getMessage();
        }

        return response()->json($response, 200);
    }

    /**
     * @param $id
     * @return string
     */

    public function success($id)
    {
        try {
            $response = Click::find(base64_decode($id));
        } catch (\Exception $e) {

            return $e->getMessage();
        }

        return response()->json($response, 200);
    }

}
