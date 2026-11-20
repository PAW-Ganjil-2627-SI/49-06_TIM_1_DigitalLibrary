@csrf
<div class="mb-3">
    <label class="form-label">Judul Buku</label>
    <input type="text" name="judul" value="{{ old('judul', $buku->judul ?? '') }}"
           class="form-control @error('judul') is-invalid @enderror">
    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">ISBN</label>
    <input type="text" name="isbn" value="{{ old('isbn', $buku->isbn ?? '') }}"
           class="form-control @error('isbn') is-invalid @enderror">
    @error('isbn')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Pengarang</label>
    <input type="text" name="pengarang" value="{{ old('pengarang', $buku->pengarang ?? '') }}"
           class="form-control @error('pengarang') is-invalid @enderror">
    @error('pengarang')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Tahun Terbit</label>
    <input type="number" name="tahun_terbit" min="1000" max="2155"
           value="{{ old('tahun_terbit', $buku->tahun_terbit ?? '') }}"
           class="form-control @error('tahun_terbit') is-invalid @enderror">
    @error('tahun_terbit')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
        <option value="">-- Pilih --</option>
        @foreach ($kategoriList as $k)
            <option value="{{ $k }}" @selected(old('kategori', $buku->kategori ?? '') === $k)>{{ $k }}</option>
        @endforeach
    </select>
    @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<button class="btn btn-success">Simpan Buku</button>
<a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
