@extends('home')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center">KRITERIA</h4>
                <div class="card border-0 shadow-sm rounded-sm mt-4">
                    <div class="d-flex justify-content-start mb-1 ml-3 mt-3">
                        <div class="class-body">
                            <a href="javascript:void(0)" class="btn btn-success ml-3" id="btn-create-kriteria">Tambah <i class="bi bi-plus-square"></i></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-stripped">
                            <tr class="text-center">
                                <th>Bobot</th>
                                <th>Kriteria</th>
                                <th>Opsi</th>
                            </tr>
                            <tbody class="text-center" id="table-kriteria"></tbody>
                            @foreach ($kriterias as $kriteria )

                            <tr id="index_{{ $kriteria->id }}" class="text-center">
                                <td>{{ $kriteria->kriteria }}</td>
                                <td>{{ $kriteria->bobot * 100 }} %</td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" id="btn-edit-kri" data-id="{{ $kriteria->id }}" class="btn btn-primary btn-sm">Edit <i class="bi bi-pencil-square"></i></a>
                                    <a href="javascript:void(0)" id="btn-delete-kriteria" data-id="{{ $kriteria->id }}" class="btn btn-danger btn-sm">Delete <i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            <tr class="text-center">
                                <td>Jumlah Total</td>
                                <td>{{ $total * 100 }} %</td>
                            </tr>
                            {{-- <tr>
                                <td>Bobot Maximal</td>
                                <td>{{ $botMax }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Data</td>
                                <td>{{ $jumBaris }}</td>
                            </tr> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.bobotKriteria.modal-create')
    @include('components.bobotKriteria.modal-edit')
    @include('components.bobotKriteria.modal-destroy')
</body>
</html>

@endsection
