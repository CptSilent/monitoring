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
            <div id="chart"></div>
            <div id="chart1"></div>
            <div id="chart2"></div>
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var data = {!!$rawResponse!!};

    // $(document).ready(function () {
    //     $('.nav-tabs a').on('click', function (e) {
    //         e.preventDefault();
    //         $(this).tab('show');
    //     });
    // });
    var datasets = [
        { name: 'Unitel', data: data.serverZones["erp.unitel.mn"].responses },
        { name: 'Unknown', data: data.serverZones["_"].responses },
        { name: 'Unknown1', data: data.serverZones["*"].responses }
    ];
    var optionsArray = [];

    for (var i = 0; i < datasets.length; i++) {
        var dataset = datasets[i];

        //     var options = {
        //         series: [{
        //             name: dataset.name,
        //             data: Object.values(dataset.data)
        //         }],
        //         chart: {
        //             height: 350,
        //             type: 'bar',
        //         },
        //         plotOptions: {
        //             bar: {
        //                 borderRadius: 10,
        //                 dataLabels: {
        //                     position: 'top', // top, center, bottom
        //                 },
        //             }
        //         },
        //         dataLabels: {
        //             enabled: true,
        //             formatter: function (val) {
        //                 return val + "%";
        //             },
        //             offsetY: -20,
        //             style: {
        //                 fontSize: '12px',
        //                 colors: ["#304758"]
        //             }
        //         },
        //         xaxis: {
        //             categories: Object.keys(dataset.data),
        //             position: 'top',
        //             axisBorder: {
        //                 show: false
        //             },
        //             axisTicks: {
        //                 show: false
        //             },
        //             crosshairs: {
        //                 fill: {
        //                     type: 'gradient',
        //                     gradient: {
        //                         colorFrom: '#D8E3F0',
        //                         colorTo: '#BED1E6',
        //                         stops: [0, 100],
        //                         opacityFrom: 0.4,
        //                         opacityTo: 0.5,
        //                     }
        //                 }
        //             },
        //             tooltip: {
        //                 enabled: true,
        //             }
        //         },
        //         yaxis: {
        //             axisBorder: {
        //                 show: false
        //             },
        //             axisTicks: {
        //                 show: false,
        //             },
        //             labels: {
        //                 show: false,
        //                 formatter: function (val) {
        //                     return val + "%";
        //                 }
        //             }
        //         },
        // title: {
        //     text: 'Unitel Database Response Status ' + dataset.name,
        //     floating: true,
        //     offsetY: 330,
        //     align: 'center',
        //     style: {
        //         color: '#444'
        //     }
        // }
        //     };
        // optionsArray.push(options);
        // }

            var options = {
                series: Object.values(dataset.data), // Update series for pie chart
                chart: {
                    height: 350,
                    type: 'pie', // Change chart type to pie
                },
                labels: Object.keys(dataset.data), // Set labels for pie chart
                plotOptions: {
                    pie: {
                        offsetY: 0,
                        startAngle: 0,
                        endAngle: 270,
                        dataLabels: {
                            offset: 0,
                        }
                    }
                },
                title: {
                    text: 'Database Response Status - ' + dataset.name,
                    floating: true,
                    offsetY: 30,
                    align: 'left',
                    style: {
                        color: '#444'
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };
            optionsArray.push(options);
        }

        var chart = new ApexCharts(document.querySelector("#chart"), optionsArray[0]);
        var chart1 = new ApexCharts(document.querySelector("#chart1"), optionsArray[1]);
        var chart2 = new ApexCharts(document.querySelector("#chart2"), optionsArray[2]);
        chart.render();
        chart1.render();
        chart2.render();

</script>
@endsection