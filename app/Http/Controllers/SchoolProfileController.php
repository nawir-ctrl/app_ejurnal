<?php

namespace App\Http\Controllers;

use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function edit()
    {
        $profile = SchoolProfile::first();
        // Jika belum ada data sama sekali (setelah migrate fresh), buatkan satu
        if (!$profile) {
            $profile = SchoolProfile::create(['name' => 'Nama Sekolah']);
            
        }
        return view('admin.school-profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = SchoolProfile::first();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'npsn' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'principal_name' => 'nullable|string|max:255',
            'principal_nip' => 'nullable|string|max:50',
            'treasurer_name' => 'nullable|string|max:255',
            'treasurer_nip' => 'nullable|string|max:50',    
            'academic_year' => 'nullable|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        if ($request->hasFile('logo')) {
            if ($profile->logo_path) {
                Storage::disk('public')->delete($profile->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('school', 'public');
        }

        $profile->update($validated);

        return back()->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}