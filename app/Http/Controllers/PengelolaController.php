<?php

namespace App\Http\Controllers;

class PengelolaController extends Controller
{
    public function request()
    {
        auth()->user()->update([
            'is_approved' => false
        ]);

        return back()->with('success',
            'Permintaan menjadi pengelola dikirim');
    }
}

