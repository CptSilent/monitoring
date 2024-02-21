@extends('layouts.app')

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Monitoring module') }}
    </h2>
</x-slot>

<div class="container">
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
            @if(isset($error))
                <p>Error: {{ $error }}</p>
            @elseif(isset($rawResponse))
                @if(isset($statusCode))
                    <p>HTTP Status Code: {{ $statusCode }}</p>
                @endif
                <h4>Host Name: {{ $rawResponse['hostName'] ?? 'N/A' }}</h4>
                <p>Module Version: {{ $rawResponse['moduleVersion'] ?? 'N/A' }}</p>
                <p>Nginx Version: {{ $rawResponse['nginxVersion'] ?? 'N/A' }}</p>
                <pre>{{ json_encode(json_decode($rawResponse, true), JSON_PRETTY_PRINT) }}</pre>
            @else
                <p>No data available.</p>
            @endif
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('.nav-tabs a').on('click', function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
@endsection
