<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Project1;
use App\Models\HtmlAnalysisResult;
use App\Models\PerformanceScore;
use App\Models\Element;

class PythonController extends Controller
{
    public function run(Request $request)
    {
        $url = $request->input('url');
        $value1 = $request->input('value1');
        $value2 =$request->input('value2');
        $value3 =$request->input('value3');
        $value4 =$request->input('value4');

        $model = new Project1();
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

        // Check if the checkbox is selected in the frontend
        $runFunctions = $request->input('run_functions');

        if ($runFunctions) {
         // Save the header_elements to the database
         $this->saveElementsToDatabase($performance_scores);
        // Save the footer_elements to the database
        $this->saveElementsToDatabase($performance_scores);
        // Save the main_content_elements to the database
        $this->saveElementsToDatabase($performance_scores);
       // Save the performance_scores to the database
        $this->savePerformanceScores($performance_scores);
       // Save the html_analysis_results to the database
        $this->saveHtmlAnalysisResults($html_analysis_results);
       }

        // Return the combined result as JSON response
        return response()->json($combined_result);
    }
    // Function to save the html_analysis_results to the database
    public function saveHtmlAnalysisResults($html_analysis_results)
    {
        $htmlAnalysisResult = new HtmlAnalysisResult();
        $htmlAnalysisResult->performance_scores = $html_analysis_results['performance_scoress'] ?? null;
        $htmlAnalysisResult->seo_score = $html_analysis_results['seo_score'] ?? null;
        $htmlAnalysisResult->pwa_score = $html_analysis_results['pwa_score'] ?? null;
        $htmlAnalysisResult->accessibility_score = $html_analysis_results['accessibility_score'] ?? null;
        $htmlAnalysisResult->best_practices_score = $html_analysis_results['best_practices_score'] ?? null;
        $htmlAnalysisResult->lcp_metric = $html_analysis_results['lcp_metric'] ?? null;
        $htmlAnalysisResult->cls_metric = $html_analysis_results['cls_metric'] ?? null;
        $htmlAnalysisResult->fcp_metric = $html_analysis_results['fcp_metric'] ?? null;
        $htmlAnalysisResult->inp_metric = $html_analysis_results['inp_metric'] ?? null;
        $htmlAnalysisResult->ttfb_metric = $html_analysis_results['ttfb_metric'] ?? null;
        $htmlAnalysisResult->save();
    }
    public function savePerformanceScores($performance_scores)
    {
        foreach ($performance_scores as $key => $value) {
            // Exclude total_pages, footer_elements, header_elements, total_tags, num_header_elements, and num_footer_elements
            if (!in_array($key, ['total_pages', 'footer_elements', 'header_elements', 'total_tags', 'num_header_elements', 'num_footer_elements'])) {
                $performanceModel = new PerformanceScore();
                $performanceModel->page_number = substr($key, 5);
                if (isset($value['href'])) {
                    $performanceModel->href = $value['href'];
                }
                if (isset($value['response_time'])) {
                    $performanceModel->response_time = $value['response_time'];
                }
                $performanceModel->save();
            }
        }
    }

    public function saveElementsToDatabase($performance_scores)
    {
        if (isset($performance_scores['footer_elements'])) {
            $footer_elements = $performance_scores['footer_elements'];
            foreach ($footer_elements as $element) {
                Element::create([
                    'name' => $element['name'],
                    'class' => json_encode($element['class']),
                    'type' => 'footer',
                ]);
            }
        }

        if (isset($performance_scores['header_elements'])) {
            $header_elements = $performance_scores['header_elements'];
            foreach ($header_elements as $element) {
                Element::create([
                    'name' => $element['name'],
                    'class' => json_encode($element['class']),
                    'type' => 'header',
                ]);
            }
        }

        if (isset($performance_scores['main_content_elements'])) {
            $main_content_elements = $performance_scores['main_content_elements'];
            foreach ($main_content_elements as $element) {
                Element::create([
                    'name' => $element['name'],
                    'class' => json_encode($element['class']),
                    'type' => 'main_content',
                ]);
            }
        }
    }

}
