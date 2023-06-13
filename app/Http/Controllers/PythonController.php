<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Project1;


class PythonController extends Controller
{
    public function run(Request $request)
    {
        $url = $request->input('url');
        $value1 = $request->input('value1');
        $value2 =$request->input('value2');
        $value3 =$request->input('value3');
        $value4 =$request->input('value4');

        $model = new Project1;
        $model->url = $url;
        $model->value1 = $value1;
        $model->value2 = $value2;
        $model->value3 = $value3;
        $model->value4 = $value4;

       // Save the model to the database
        $model->save();

        $output = exec("python C:\Users\lenovo\Documents\PFE\python\cc.py $url $value1 $value2 $value3 $value4");
        Log::info('Info message');

        $model->output = $output;
        $model->save();

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
    public function getScores(Request $request)
{
    ini_set('max_execution_time', 400); // 5 minutes

    // Get the URL from the request
    $url = $request->input('url');

    // Call the Python script to get the performance scores
    $performance_scores = json_decode(shell_exec("python C:\Users\lenovo\Documents\PFE\python\Fight.py $url"), true);

    // Call the Python script to get the HTML analysis results
    $html_analysis_results = json_decode(shell_exec("python C:\Users\lenovo\Documents\PFE\python\Essai.py $url"), true);

    // Combine the results
    $combined_result = [
        'performance_scores' => $performance_scores,
        'html_analysis_results' => $html_analysis_results
    ];

    // Return the combined result as JSON response
    return response()->json($combined_result);
}
}
