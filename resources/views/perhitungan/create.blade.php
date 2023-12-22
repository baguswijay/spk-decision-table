
<div class="form-body">
    <form action="{{ route('hitung.store') }}" method="post">
        @csrf
        <div class="form-floating">
            <input type="text" name="nama" id="nama" class="form-control mb-3">
            <label for="nama">Nama Makanan</label>
        </div>
        <div class="form-floating">
            <select name="id_protein" id="protein" class="form-select">
                @foreach ( $proteinOptions as $proteinOption )
                    <option value="{{ $proteinOption->id }}">{{ $proteinOption->nilai }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>
