@csrf
@foreach ([
    'judul' => 'Judul', 'penulis' => 'Penulis',
    'tahun_terbit' => 'Tahun Terbit', 'stok' => 'Stok'
] as $field => $label)
    <div class="mb-3">
        <label class="form-label">{{ $label }}</label>
        <input type="{{ in_array($field, ['tahun_terbit', 'stok']) ? 'number' : 'text' }}"
               name="{{ $field }}"
               value="{{ old($field, $buku->$field ?? '') }}"
               class="form-control @error($field) is-invalid @enderror">
        @error($field)<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
@endforeach
<button class="btn btn-success">Simpan</button>
<a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>