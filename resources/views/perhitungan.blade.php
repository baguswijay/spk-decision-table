<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Halo</h2>
    <select name="id_protein">
        @foreach($proteinOptions as $proteinOption)
            <option value="{{ $proteinOption->id }}"> {{ $proteinOption->protein }} | {{ $proteinOption->nilai }}</option>
        @endforeach
    </select>
    {{-- @foreach ( $hasil as $nilai ) --}}
        {{-- <h1>Hasil: {{ $hasil }}</h1> --}}
    {{-- @endforeach --}}
</body>
</html>

