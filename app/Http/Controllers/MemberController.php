<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $members = Member::when($q, function ($query) use ($q) {
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                    ->orWhere('member_number', 'like', "%{$q}%")
                    ->orWhere('card_number', 'like', "%{$q}%");
            });
        })->latest()->paginate(10)->withQueryString();

        return view('members.index', compact('members', 'q'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['member_number'] = ($data['member_number'] ?? null) ?: $this->newNumber();
        $data['card_number'] = ($data['card_number'] ?? null) ?: 'CARD-' . $data['member_number'];

        Member::create($data);

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $this->validated($request, $member);
        $data['member_number'] = ($data['member_number'] ?? null) ?: $member->member_number;
        $data['card_number'] = ($data['card_number'] ?? null) ?: 'CARD-' . $data['member_number'];

        $member->update($data);

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil dihapus.');
    }

    private function validated(Request $request, ?Member $member = null): array
    {
        return $request->validate([
            'member_number' => ['nullable', 'string', 'max:30', Rule::unique('members', 'member_number')->ignore($member?->id)],
            'card_number' => ['nullable', 'string', 'max:40', Rule::unique('members', 'card_number')->ignore($member?->id)],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:120'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:1000'],
            'membership_type' => ['required', Rule::in(['Siswa', 'Mahasiswa', 'Umum', 'Dosen'])],
            'joined_at' => ['required', 'date'],
            'expires_at' => ['required', 'date', 'after_or_equal:joined_at'],
            'status' => ['required', Rule::in(['Aktif', 'Tidak Aktif'])],
        ]);
    }

    private function newNumber(): string
    {
        do {
            $number = 'AGT-' . date('Y') . '-' . str_pad((string) random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        } while (Member::where('member_number', $number)->exists());

        return $number;
    }
}
