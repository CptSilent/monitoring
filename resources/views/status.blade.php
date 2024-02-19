{{-- resources/views/status_dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Status Dashboard</h1>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#nginx">Nginx Status</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#database">Database</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#visualvm">VisualVM</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="nginx" class="container tab-pane active"><br>
            <h3>Nginx Status</h3>
            @foreach($nginxStatuses as $status)
                <p>Status ID: {{ $status->id }}</p>
                <p>Status Info: {{ $status->info }}</p>
            @endforeach
        </div>
        <div id="database" class="container tab-pane fade"><br>
            <h3>Database Status</h3>
            <!-- Database status content goes here -->
        </div>
        <div id="visualvm" class="container tab-pane fade"><br>
            <h3>VisualVM Status</h3>
            <!-- VisualVM status content goes here -->
        </div>
    </div>
</div>
@endsection
