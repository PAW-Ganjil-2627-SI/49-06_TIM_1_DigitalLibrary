@csrf
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Nomor Anggota <small class="text-muted">(kosongkan untuk otomatis)</small></label>
        <input type="text" name="member_number" value="{{ old('member_number', $member->member_number ?? '') }}"
               class="form-control @error('member_number') is-invalid @enderror">
        @error('member_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Nomor Kartu <small class="text-muted">(kosongkan untuk otomatis)</small></label>
        <input type="text" name="card_number" value="{{ old('card_number', $member->card_number ?? '') }}"
               class="form-control @error('card_number') is-invalid @enderror">
        @error('card_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Nama Lengkap</label>
    <input type="text" name="name" value="{{ old('name', $member->name ?? '') }}"
           class="form-control @error('name') is-invalid @enderror">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', $member->email ?? '') }}"
               class="form-control @error('email') is-invalid @enderror">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Nomor Telepon</label>
        <input type="text" name="phone" value="{{ old('phone', $member->phone ?? '') }}"
               class="form-control @error('phone') is-invalid @enderror">
        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Tipe Keanggotaan</label>
        <select name="membership_type" class="form-select @error('membership_type') is-invalid @enderror">
            @foreach (['Siswa', 'Mahasiswa', 'Umum', 'Dosen'] as $opsi)
                <option value="{{ $opsi }}" @selected(old('membership_type', $member->membership_type ?? 'Mahasiswa') === $opsi)>{{ $opsi }}</option>
            @endforeach
        </select>
        @error('membership_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            @foreach (['Aktif', 'Tidak Aktif'] as $opsi)
                <option value="{{ $opsi }}" @selected(old('status', $member->status ?? 'Aktif') === $opsi)>{{ $opsi }}</option>
            @endforeach
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Tanggal Bergabung</label>
        <input type="date" name="joined_at"
               value="{{ old('joined_at', isset($member) ? $member->joined_at->format('Y-m-d') : date('Y-m-d')) }}"
               class="form-control @error('joined_at') is-invalid @enderror">
        @error('joined_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Berlaku Sampai</label>
        <input type="date" name="expires_at"
               value="{{ old('expires_at', isset($member) ? $member->expires_at->format('Y-m-d') : date('Y-m-d', strtotime('+1 year'))) }}"
               class="form-control @error('expires_at') is-invalid @enderror">
        @error('expires_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $member->address ?? '') }}</textarea>
    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<button class="btn btn-success">Simpan</button>
<a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
