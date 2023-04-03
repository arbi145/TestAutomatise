<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PythonController extends Controller
{
    public function run(Request $request)
    {
        $url = $request->input('url');

        $output = exec("python C:\Users\lenovo\Documents\PFE\python\cc.py $url");

        return response()->json([
            'output' => $output,
        ]);
    }
    public function runPython(Request $request)
    {

        $url = $request->json('url');
        // Call your Python API with the $url parameter
        $response = Http::post('http://127.0.0.1:5000/hello', [

                'url' => $url,

    ]);
        return response()->json([
            'output' => $response->json(),'url'=>$url
        ]);



    }
}
