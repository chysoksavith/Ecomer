@extends('admin.layouts.layout')

@section('content')
    @php
        $months = [];
        $count = 0;
        while ($count <= 3) {
            // Use < instead of <= to avoid infinite loop
            $months[] = date('M Y', strtotime("-$count month")); // Append to the $months array
            $count++;
        }
        $dataPoints = [
            ['y' => $OrderCount[0], 'label' => $months[0]],
            ['y' => $OrderCount[1], 'label' => $months[1]],
            ['y' => $OrderCount[2], 'label' => $months[2]],
            ['y' => $OrderCount[3], 'label' => $months[3]],
        ];

    @endphp

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Report</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scritps')
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Orders Reports"
                },
                axisY: {
                    title: "Number of Orders Reports"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.## Orders",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
@endsection
