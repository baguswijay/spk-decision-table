
@extends('home')
@section('content')

    <div class="form-body">
        <form action="{{ route('hitung.store') }}" method="post">
            @csrf
            <div class="form-floating col-md-6">
                <input type="text" name="nama" id="nama" class="form-control mb-3">
                <label for="nama">Nama Makanan</label>
            </div>
            <div class="form-floating col-md-6">
                <select name="id_protein" id="protein" class="form-select">
                    <option value="">Pilih Nilai Protein</option>
                    @foreach ( $proteinOptions as $proteinOption )
                        <option value="{{ $proteinOption->id }}">{{ $proteinOption->protein }} | {{ $proteinOption->nilai }}</option>
                    @endforeach
                </select>
                <label for="protein">Protein</label>
            </div>
            <div class="form-floating col-md-6">
                <select name="id_karbohidrat" id="karbohidrat" class="form-select">
                    <option value="">-Pilih Nilai Karbohidrat-</option>
                    @foreach ( $karbohidratOptions as $karbohidratOption )
                        <option value="{{ $karbohidratOption->id }}">{{ $karbohidratOption->karbohidrat }} | {{ $karbohidratOption->nilai }}</option>
                    @endforeach
                </select>
                <label for="karbohidrat">Karbohidrat</label>
            </div>
            <div class="form-floating col-md-6">
                <select name="id_kalori" id="kalori" class="form-select">
                    <option value=""> -Pilih Nilai Kalori-</option>
                    @foreach ( $kaloriOptions as $kaloriOption )
                        <option value="{{ $kaloriOption->id }}">{{ $kaloriOption->kalori }} | {{ $kaloriOption->nilai }}</option>
                    @endforeach
                </select>
                <label for="kalori">Kalori</label>
            </div>
            <div class="form-floating col-md-6">
                <select name="id_natrium" id="natrium" class="form-select">
                    <option value="">-Pilih Nilai Natrium-</option>
                    @foreach ( $natriumOptions as $natriumOption )
                        <option value="{{ $natriumOption->id }}">{{ $natriumOption->natrium }} | {{ $natriumOption->nilai }}</option>
                    @endforeach
                </select>
                <label for="natrium">Natrium</label>
            </div>
            <div class="form-floating col-md-6">
                <select name="id_usia" id="usia" class="form-select">
                    <option value="">-Pilih Nilai Usia-</option>
                    @foreach ( $usiaOptions as $usiaOption )
                        <option value="{{ $usiaOption->id }}">{{ $usiaOption->natrium }} | {{ $usiaOption->nilai }}</option>
                    @endforeach
                </select>
                <label for="usia">Usia</label>
            </div>
            <div class="button">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>

    <table class="table table-striped text-center">
        <tr>
            <th>No</th>
            <th>Nama</th>
            @foreach ( $kriteria as $kri)
                <th>{{ $kri->kriteria }}</th>
            @endforeach
            {{-- <th>Protein</th>
            <th>Karbohidrat</th>
            <th>Kalori</th> --}}
            <th>Hasil</th>
            <th>Opsi</th>
        </tr>
        @foreach ( $hitungs as $hitung )

            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $hitung->nama }}</td>
                <td>
                    @foreach ( $dataProtein as $ket)
                        @if ($ket->nama == $hitung->nama)
                            {{ $ket->protein->nilai }}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ( $dataKarbohidrat as $karbo )
                        @if($karbo->nama == $hitung->nama)
                            {{ $karbo->karbohidrat->nilai }}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ( $dataKalori as $kal )
                        @if($kal->nama == $hitung->nama)
                            {{ $kal->kalori->nilai }}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ( $dataNatrium as $natrium )
                        @if($natrium->nama == $hitung->nama)
                            {{ $natrium->natrium->nilai }}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ( $dataUsia as $usia )
                        @if($usia->nama == $hitung->nama)
                            {{ $usia->usia->nilai }}
                        @endif
                    @endforeach
                </td>
                <td>{{ $hitung->hasil }}</td>
                <td>
                    <a href="{{ route('hitung.edit', $hitung->id) }}"><button class="btn btn-info">Edit</button></a>
                    <a href="{{ route('hitung.destroy', $hitung->id) }}"><button class="btn btn-danger">Hapus</button></a>
                </td>
            </tr>

        @endforeach
    </table>
    @if( $maxData == null)
        <p>Tidak ada hasil</p>
    @else

    <p>Jadi Makanan yang direkomendasikan adalah <b>@foreach ( $maxData as $max )
        {{ $max->nama }};
        @endforeach</b> dengan nilai sebesar <b>{{ $max->hasil }}</b>

    @endif
@endsection

