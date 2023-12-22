@extends('home')

@section('content')
    <div class="button">
        <a href="{{ route('hitung.index') }}"><button class="btn btn-info">Kembali</button></a>
    </div>
    <div class="form-body">
        <form action="{{ route('hitung.update', $hitungs->id) }}" method="post">
        @csrf
        <div class="form-floating col-md-6">
            <input type="text" name="nama" id="nama" class="form-control mb-3" value="{{ $hitungs->nama }}">
            <label for="nama">Nama Makanan</label>
        </div>
        <div class="form-floating col-md-6">
            <select name="id_protein" id="protein" class="form-select">
                {{-- @foreach ( $dataProtein as $ket)
                <option value="{{ $ket->protein->nilai }}" @if ($ket->nama == $hitungs->nama) @endif selected>
                </option>
                @endforeach --}}
                @foreach ( $proteinOptions as $proteinOption )
                    <option value="{{ $proteinOption->id }}" @if($proteinOption->id == $hitungs->id_protein) selected @endif >{{ $proteinOption->nilai }}</option>
                @endforeach
            </select>
            <label for="protein">Protein</label>
        </div>
        <div class="form-floating col-md-6">
            <select name="id_karbohidrat" id="karbohidrat" class="form-select">
                @foreach ( $karbohidratOptions as $karbohidratOption )
                    <option value="{{ $karbohidratOption->id }}" @if($karbohidratOption->id == $hitungs->id_karbohidrat)
                        selected
                    @endif> {{ $karbohidratOption->nilai }} </option>
                @endforeach
            </select>
        </div>
        <div class="form-floating col-md-6">
            <select name="id_kalori" id="kalori" class="form-select">
                @foreach ( $kaloriOptions as $kaloriOption )
                    <option value="{{ $kaloriOption->id }}" @if($kaloriOption->id == $hitungs->id_kalori)
                        selected
                    @endif>{{ $kaloriOption->nilai }}</option>
                @endforeach
            </select>
        </div>
        <div class="button">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
        </form>
    </div>
@endsection
