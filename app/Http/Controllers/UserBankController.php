<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\UserBank;
use Illuminate\Http\Request;

class UserBankController extends Controller
{
    public function create()
    {
        $banks = Bank::all(); // ambil master bank

        return view('bank.create', compact('banks'));
    }

    public function store(Request $request)
    {
        $bankName = Bank::find($request->bank_id)->name;

        $request->validate([
            'bank_id'        => 'required|exists:banks,id',
            'account_number' => 'required|numeric|digits_between:8,20|unique:user_banks,account_number',
            'ktp'            => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();

        // SIMPAN KTP
        $ktpPath = $request->file('ktp')->store('ktp');

        if (!$user->ktp_path) {
            $user->update([
                'ktp_path' => $ktpPath
            ]);
        }

        // SIMPAN BANK
        $userBank = UserBank::create([
            'user_id'        => $user->id,
            'bank_id'        => $request->bank_id,
            'account_number' => $request->account_number,
            'balance'        => 0,
            'is_primary'     => false,
        ]);

        // 🔔 NOTIFIKASI
        $user->notifications()->create([
            'user_id'  => $user->id, // optional kalau relasi sudah otomatis
            'actor_id' => $user->id, // 🔥 penting
            'title'    => 'Rekening Berhasil Ditambahkan',
            'message'  => "Rekening {$bankName} ({$userBank->account_number}) berhasil ditambahkan",
            'type'     => 'bank_created',
        ]);


        return redirect()->route('bank.success');
    }
}
