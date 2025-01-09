<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saran;

class SaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'isi' => 'required',
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Validasi file
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('sarans', 'public'); // Simpan file ke public storage
        }

        Saran::create([
            'isi' => $request->isi,
            'file' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Saran berhasil dikirim!');
    }
}
