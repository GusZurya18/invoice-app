<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(15);

        // Statistik Customer
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::has('invoices')->count(); // punya invoice
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

        $customer = Customer::create($validated);

        // Jika request dari AJAX (dari modal di invoice create)
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'customer' => $customer,
                'message' => 'Customer berhasil dibuat!'
            ], 201);
        }

        // Jika request biasa (dari halaman customer create)
        return redirect()->route('customers.index')
            ->with('success', 'Customer berhasil dibuat!');
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
                'message' => 'Customer berhasil diupdate!'
            ]);
        }

        return redirect()->route('customers.index')
            ->with('success', 'Customer berhasil diupdate!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        
        // Jika request dari AJAX
        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Customer berhasil dihapus!'
            ]);
        }

        return redirect()->route('customers.index')
            ->with('success', 'Customer berhasil dihapus!');
    }
}