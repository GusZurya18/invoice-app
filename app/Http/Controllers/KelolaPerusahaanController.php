<?php

namespace App\Http\Controllers;

use Faker\Provider\Company;
use Illuminate\Http\Request;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Storage;

class KelolaPerusahaanController extends Controller
{
    public function index()
    {
        $company = CompanySetting::latest()->paginate(15);

        $totalCompany = CompanySetting::count();
        $activeCompany = CompanySetting::where('aktif', 1)->count();
        $inactiveCompany = $totalCompany - $activeCompany;
        return view('company.index', compact(
            'company',
            'totalCompany',
            'activeCompany',
            'inactiveCompany'
        ));
    }
    public function create()
    {
        return view('company.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'company_name'         => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|string|max:20',
            'alamat'   => 'nullable|string',
            'negara'        => 'required|string',
            'provinsi'      => 'required|string',
            'kota'          => 'required|string',
            'postal_code'   => 'required|string|max:10',
            'logo'          => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'npwp'          => 'nullable|string|max:50',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('company/logo', 'public');
        }

        CompanySetting::create([
            'company_name'  => $request->company_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->alamat,
            'country'       => $request->negara,
            'province'      => $request->provinsi,
            'city'          => $request->kota,
            'postal_code'   => $request->postal_code,
            'npwp'          => $request->npwp ?? null,
            'logo'          => $logoPath,
        ]);

        return redirect()->route('superadmin.kelola-perusahaan')
            ->with('success', 'Data perusahaan berhasil ditambahkan.');
    }
    public function edit(Request $request, $id)
    {
        $company = CompanySetting::findOrFail($id);
        return view('company.edit', compact('company'));
    }
    public function update(Request $request, $id)
    {
        $company = CompanySetting::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:20',
            'address'      => 'nullable|string',
            'country'      => 'required|string',
            'province'     => 'required|string',
            'city'         => 'required|string',
            'postal_code'  => 'required|string|max:10',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'npwp'         => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('logo')) {

            // hapus logo lama jika ada
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }

            $company->logo = $request->file('logo')->store('company/logo', 'public');
        }

        $company->update([
            'company_name' => $request->company_name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'country'      => $request->country,
            'province'     => $request->province,
            'city'         => $request->city,
            'postal_code'  => $request->postal_code,
            'npwp'         => $request->npwp,
        ]);

        return redirect()
            ->route('superadmin.kelola-perusahaan')
            ->with('success', 'Data perusahaan berhasil diperbarui.');
    }
    public function destroy(CompanySetting $company)
    {
        $company->delete();

        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Customer berhasil dihapus!'
            ]);
        }

        return redirect()->route('companys.index')
            ->with('success', 'Customer berhasil dihapus!');
    }
}
