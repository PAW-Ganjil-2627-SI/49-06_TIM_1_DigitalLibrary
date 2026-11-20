@csrf
<div class="mb-3">
    <label class="form-label">Nama Supplier</label>
    <input type="text" name="nama_supplier" placeholder="Masukkan nama supplier"
           value="{{ old('nama_supplier', $supplier->nama_supplier ?? '') }}"
           class="form-control @error('nama_supplier') is-invalid @enderror">
    @error('nama_supplier')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Nomor Telepon</label>
    <input type="text" name="no_telp" placeholder="Contoh: 0812-0000-0001"
           value="{{ old('no_telp', $supplier->no_telp ?? '') }}"
           class="form-control @error('no_telp') is-invalid @enderror">
    @error('no_telp')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea name="alamat" rows="3" placeholder="Masukkan alamat supplier"
              class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $supplier->alamat ?? '') }}</textarea>
    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Wilayah Asal</label>
    <input type="text" name="wilayah_asal" placeholder="Contoh: Jawa Barat"
           value="{{ old('wilayah_asal', $supplier->wilayah_asal ?? '') }}"
           class="form-control @error('wilayah_asal') is-invalid @enderror">
    @error('wilayah_asal')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<button class="btn btn-success">Simpan Supplier</button>
<a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Batal</a>
