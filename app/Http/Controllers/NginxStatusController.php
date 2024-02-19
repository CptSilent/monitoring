<?php

// app/Http/Controllers/NginxStatusController.php

namespace App\Http\Controllers;

use App\Models\NginxStatus;
use App\Models\VisualVM;
use GuzzleHttp\Client;
use App\Models\Database; // Adjust this to your actual model name if different

class NginxStatusController extends Controller
{

    public function dashboard()
    {
        $nginxStatuses = NginxStatus::all();
        $visualVMs = VisualVM::all();
        $databases = Database::all(); // Ensure this matches your actual Database model

        return view('status', compact('nginxStatuses', 'visualVMs', 'databases'));
    }
    public function status()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://your-nginx-server/status/format/json');
        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        if($statusCode == 200) {
            $nginxStatuses = json_decode($content, true);
        } else {
            $nginxStatuses = [];
        }

        // Assuming you're also fetching $visualVMs and $databases similarly
        return view('status_dashboard', compact('nginxStatuses', 'visualVMs', 'databases'));
    }
}
