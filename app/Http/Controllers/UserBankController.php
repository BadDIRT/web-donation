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
        $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'account_number' => 'required|numeric|digits_between:8,20',
        ]);

        $user = auth()->user();

        UserBank::create([
            'user_id' => $user->id,
            'bank_id' => $request->bank_id,
            'account_number' => $request->account_number,
            'balance' => 0,
            'is_primary' => false,
        ]);

        return redirect()
            ->route('dashboard') // sesuaikan route dashboard lo
            ->with('success', '✅ Rekening berhasil ditambahkan');
    }
}