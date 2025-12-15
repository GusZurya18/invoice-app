<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $companyId = $user->company_id;

        $customers = Customer::where('company_id', $companyId)->latest()->paginate(15);

        // Statistik Customer
        $totalCustomers = Customer::where('company_id', $companyId)->count();
        $activeCustomers = Customer::where('company_id', $companyId)->has('invoices')->count(); 
        $inactiveCustomers = $totalCustomers - $activeCustomers;

        return view('customers.index', compact(
            'customers',
            'totalCustomers',
            'activeCustomers',
            'inactiveCustomers'
        ));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['company_id'] = Auth::user()->company_id;
        
        $customer = Customer::create($validated);

        // Jika request dari AJAX (dari modal di invoice create)
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'customer' => $customer,
                'message' => 'Pelanggan berhasil dibuat!'
            ], 201);
        }

        // Jika request biasa (dari halaman customer create)
        return redirect()->route('admin.customers.index')
            ->with('success', 'Pelanggan berhasil dibuat!');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,'.$customer->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $customer->update($validated);

        // Jika request dari AJAX
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'customer' => $customer,
                'message' => 'Pelanggan berhasil diperbarui!'
            ]);
        }

        return redirect()->route('admin.customers.index')
            ->with('success', 'Pelanggan berhasil diperbarui!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        
        // Jika request dari AJAX
        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pelanggan berhasil dihapus!'
            ]);
        }

        return redirect()->route('admin.customers.index')
            ->with('success', 'Pelanggan berhasil dihapus!');
    }
}