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
        'totalCustomers','activeCustomers','inactiveCustomers'
    ));

        $customers = Customer::latest()->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:customers',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer berhasil dibuat!');
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
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:customers,email,'.$customer->id,
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer berhasil diupdate!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer berhasil dihapus!');
    }
}
