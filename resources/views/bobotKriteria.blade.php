@extends('home')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>Bobot</th>
            <th>Kriteria</th>
        </tr>
        @foreach ($kriterias as $kriteria )

        <tr>
            <td>{{ $kriteria->kriteria }}</td>
            <td>{{ $kriteria->bobot * 100 }} %</td>
        </tr>
        @endforeach
        <tr>
            <td>Jumlah Total</td>
            <td>{{ $total * 100 }} %</td>
        </tr>
        <tr>
            <td>Bobot Maximal</td>
            <td>{{ $botMax }}</td>
        </tr>
        <tr>
            <td>Jumlah Data</td>
            <td>{{ $jumBaris }}</td>
        </tr>
    </table>
</body>
</html>

@endsection
