<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        // Kalau belum ada data, buat default
        if (!$setting) {
            $setting = Setting::create([
                'nama_toko' => 'POS ADITYA',
                'alamat'    => '',
                'telepon'   => '',
                'email'     => '',
            ]);
        }

        return view('pengaturan.index', compact('setting'));
    }

    public function update(Request $request)
{
    $request->validate([
        'nama_toko'  => 'required|string|max:100',
        'alamat'     => 'nullable|string',
        'telepon'    => 'nullable|string|max:20',
        'email'      => 'nullable|email|max:100',
        'logo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'bahasa'     => 'required|in:id,en',
        'mata_uang'  => 'required|in:IDR,USD',
        'per_page'   => 'required|integer|min:5|max:100',
    ]);

    $setting = Setting::first();

    $data = $request->only([
        'nama_toko', 'alamat', 'telepon', 'email',
        'bahasa', 'mata_uang', 'per_page'
    ]);

    if ($request->hasFile('logo')) {
        if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
            Storage::disk('public')->delete($setting->logo);
        }
        $data['logo'] = $request->file('logo')->store('logo', 'public');
    }

    $setting->update($data);

    return redirect()->route('pengaturan.index')
                     ->with('success', 'Pengaturan berhasil diperbarui.');
}
    public function edit()
{
    $setting = Setting::first();

    if (!$setting) {
        $setting = Setting::create([
            'nama_toko' => 'POS ADITYA',
            'alamat'    => '',
            'telepon'   => '',
            'email'     => '',
        ]);
    }

    return view('pengaturan.edit', compact('setting'));
}
}