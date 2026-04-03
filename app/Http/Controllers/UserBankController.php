<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\UserBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function manage()
    {
        // Hanya mengambil rekening milik admin yang sedang login
        $userBanks = UserBank::with('bank')
            ->where('user_id', auth()->id())
            ->orderByDesc('is_primary') // Urutkan, yang utama paling atas
            ->get();

        return view('manage-banks.index', compact('userBanks'));
    }

    /**
     * UBAH REKENING UTAMA (DEFAULT)
     */
    public function setPrimary(UserBank $userBank)
    {
        // 🛡️ KEAMANAN: Pastikan rekening ini benar-benar milik admin yang login
        if ($userBank->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke rekening ini.');
        }

        DB::beginTransaction();
        try {
            // 1. Matikan status utama di SEMUA rekening admin
            UserBank::where('user_id', auth()->id())
                ->update(['is_primary' => false]);

            // 2. Aktifkan status utama di rekening yang dipilih
            $userBank->update(['is_primary' => true]);

            DB::commit();

            return back()->with('success', 'Rekening utama berhasil diubah ke ' . $userBank->bank->name . ' - ' . $userBank->account_number);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengubah rekening utama.');
        }
    }

    public function destroy(UserBank $userBank)
    {
        // Cegah hapus rekening milik user lain
        if ($userBank->user_id !== auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus rekening ini.');
        }

        // Cegah hapus rekening utama
        if ($userBank->is_primary) {
            return back()->with('error', 'Rekening utama tidak dapat dihapus. Jadikan rekening lain sebagai utama terlebih dahulu.');
        }

        $bankName = $userBank->bank->name;
        $userBank->delete();

        return back()->with('success', "Rekening {$bankName} berhasil dihapus.");
    }
}
