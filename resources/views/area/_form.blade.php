@csrf
<div class="mb-3">
    <label class="form-label">Kode Area</label>
    <input type="text" name="kode_area" value="{{ old('kode_area', $area->kode_area ?? '') }}"
           class="form-control @error('kode_area') is-invalid @enderror">
    @error('kode_area')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Jenis</label>
    <select name="jenis" class="form-select @error('jenis') is-invalid @enderror">
        @foreach (['Meja Baca', 'Bilik Baca'] as $opsi)
            <option value="{{ $opsi }}" @selected(old('jenis', $area->jenis ?? '') === $opsi)>{{ $opsi }}</option>
        @endforeach
    </select>
    @error('jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Nomor Lantai</label>
    <input type="number" name="nomor_lantai" value="{{ old('nomor_lantai', $area->nomor_lantai ?? '') }}"
           class="form-control @error('nomor_lantai') is-invalid @enderror">
    @error('nomor_lantai')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <div class="form-check">
        <input type="checkbox" name="stopkontak" value="1" id="stopkontak" class="form-check-input"
               @checked(old('stopkontak', $area->stopkontak ?? false))>
        <label class="form-check-label" for="stopkontak">Ada stopkontak</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="wifi" value="1" id="wifi" class="form-check-input"
               @checked(old('wifi', $area->wifi ?? false))>
        <label class="form-check-label" for="wifi">Ada WiFi</label>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Status Ketersediaan</label>
    <select name="status" class="form-select @error('status') is-invalid @enderror">
        @foreach (['Tersedia', 'Terpakai'] as $opsi)
            <option value="{{ $opsi }}" @selected(old('status', $area->status ?? 'Tersedia') === $opsi)>{{ $opsi }}</option>
        @endforeach
    </select>
    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<button class="btn btn-success">Simpan</button>
<a href="{{ route('area.index') }}" class="btn btn-secondary">Batal</a>