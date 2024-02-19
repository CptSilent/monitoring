<?php

// app/Http/Controllers/NginxStatusController.php

namespace App\Http\Controllers;

use App\Models\NginxStatus;
use App\Models\VisualVM;
use App\Models\Database; // Adjust this to your actual model name if different

class NginxStatusController extends Controller
{
    public function status()
    {
        $nginxStatuses = NginxStatus::all();
        $visualVMs = VisualVM::all();
        $databases = Database::all(); // Ensure this matches your actual Database model

        return view('status', compact('nginxStatuses', 'visualVMs', 'databases'));
    }
    public function dashboard()
    {
        $nginxStatuses = NginxStatus::all();
        $visualVMs = VisualVM::all();
        $databases = Database::all(); // Ensure this matches your actual Database model

        return view('status', compact('nginxStatuses', 'visualVMs', 'databases'));
    }
}
