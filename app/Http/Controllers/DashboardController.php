<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Your logic here, e.g., aggregating different stats or simply returning a view
        return view('dashboard');
    }
}
