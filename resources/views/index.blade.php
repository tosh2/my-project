<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-3">Parking Report</h2>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-danger">
                    <th scope="col">Núm. placa</th>
                    <th scope="col">Tiempo estacionado (min.)</th>
                    <th scope="col">Cantidad a pagar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($record ?? '' as $data)
                <tr>
                    <th scope="row">fd</th>
                    <td>{{ $data->time_in_minutes }}</td>
                    <td>{{ $data->calculated_total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>