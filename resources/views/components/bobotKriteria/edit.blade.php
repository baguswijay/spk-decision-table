@extends('home')

@section('content')

<div class="form-body">
    <form action="{{ route('kriterias.update') }}" method="POST">
        <div class="form-floating col-md-6">
            <input type="text" name="kriteria" id="kriteria" class="form-control mb-3" value="{{ $kriteria->kriteria }}">
            <label for="kriteria">Kriteria</label>
        </div>
        <div class="form-floating col-md-6">
            <input type="number" name="bobot" id="bobot" class="form-control mb-3" value="{{ $kriteria->bobot }}">
            <label for="bobot">Kriteria</label>
        </div>
    </form>
</div>

@endsection
