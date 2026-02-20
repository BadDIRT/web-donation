<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengelolaController extends Controller
{
    public function terms()
    {
        return view('pengelola.terms');
    }

    public function showForm()
    {
        return view('pengelola.form');
    }

    public function submit(Request $request)
    {
        $request->validate(
            [
                'phone'         => 'required|string|min:10|max:15',
                'ktp'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'bank_account'  => 'required|string|max:100',
            ],
            [
                'phone.required'        => 'Nomor handphone wajib diisi.',
                'ktp.required'          => 'Foto KTP wajib diunggah.',
                'ktp.image'             => 'File KTP harus berupa gambar.',
                'ktp.max'               => 'Ukuran foto KTP maksimal 2MB.',
                'bank_account.required' => 'Nomor rekening wajib diisi.',
            ]
        );

        $user = Auth::user();

        // Simpan file KTP
        $ktpPath = $request->file('ktp')->store('ktp', 'public');

        // Update user → jadi pengelola (menunggu approval)
        $user->update([
            'phone'        => $request->phone,
            'ktp_path'     => $ktpPath,
            'bank_account' => $request->bank_account,
            'role'         => 'pengelola',
            'is_approved'  => false,
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Pengajuan berhasil. Akun Anda sedang menunggu persetujuan admin.');
    }
}