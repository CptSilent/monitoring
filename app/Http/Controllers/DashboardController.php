<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function indexold()
    {
        // Your logic here, e.g., aggregating different stats or simply returning a view
        return view('dashboard');
    }
    public function index(Request $request): View
    {
        try {
            // Set your credentials
            $username = 'root';
            $password = '123';

            // Create a Guzzle client with SSL verification disabled
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode("$username:$password"),
                ],
                'verify' => false, // Enable SSL verification
            ]);

            // Make the HTTP request
            $response = $client->request('GET', 'https://erp.unitel.mn/status/format/json');

            // Get the HTTP status code and response content

            $statusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
            $contentT = json_encode(json_decode($content, true));
            //   var_dump($contentT);
            // $serverZones = $response->
            // Handle successful response (HTTP status code 200)
            if ($statusCode == 200) {
                // Pass the raw response to the view
                return view('dashboard', ['rawResponse' => $contentT]);
            } else {
                // Handle non-200 HTTP status code
                $nginxStatuses = ['error' => 'HTTP Request failed with status code ' . $statusCode];

                return view('dashboard', ['error' => $nginxStatuses]);
            }
        } catch (\Exception $e) {
            // Handle exceptions
            $errorMessage = $e->getMessage();

            return view('dashboard', ['error' => $errorMessage]);
        }
    }
}
