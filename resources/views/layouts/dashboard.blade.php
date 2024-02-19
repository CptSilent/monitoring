{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</head>
<body>

{{-- resources/views/status_dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <br>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#nginx">Nginx</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#database">Database</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#visualvm">VisualVM</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div id="nginx" class="container tab-pane active"><br>
            <x-status-tabs.nginx :nginxStatuses="$nginxStatuses"/>
        </div>
        <div id="database" class="container tab-pane fade"><br>
            <x-status-tabs.database :databases="$databases"/>
        </div>
        <div id="visualvm" class="container tab-pane fade"><br>
            <x-status-tabs.visual-vm :visualVMs="$visualVMs"/>
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




</body>
</html>
