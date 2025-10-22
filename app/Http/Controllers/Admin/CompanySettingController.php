<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanySettingController extends Controller
{
    public function edit()
    {
        $company = CompanySetting::current();
        return view('admin.company-settings.edit', compact('company'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'fax' => 'nullable|string|max:20',
            'npwp' => 'required|string|max:30',
            'siup_tdp' => 'nullable|string|max:50',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'account_holder_name' => 'required|string|max:255',
            'tax_rate' => 'required|numeric|min:0|max:100',
        ]);

        $company = CompanySetting::current();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($company->logo) {
                Storage::delete($company->logo);
            }
            $validated['logo'] = $request->file('logo')->store('company-logos', 'public');
        }

        $company->update($validated);

        return redirect()->back()->with('success', 'Data perusahaan berhasil diperbarui!');
    }
}