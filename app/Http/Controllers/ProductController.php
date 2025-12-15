<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $companyId = Auth::user()->company_id;
        $query = Product::whereHas('category', function ($q) use ($companyId) {
            $q->where('company_id', $companyId);
        });

        $products = $query->latest()->paginate(10);

        $totalProducts = (clone $query)->count();

        $outOfStock = (clone $query)
            ->where('stock', 0)
            ->count();

        $lowStock = (clone $query)
            ->where('stock', '<', 5)
            ->count();

        $availableProducts = (clone $query)
            ->where('stock', '>', 0)
            ->count();

        return view('products.index', compact(
            'products',
            'totalProducts',
            'outOfStock',
            'lowStock',
            'availableProducts'
        ));
    }

    public function create()
    {
        $categories = Category::where('company_id', Auth::user()->company_id)->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'photo' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product berhasil dibuat!');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('company_id', Auth::user()->company_id)->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'photo' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();
        return redirect()->route('admins.products.index')->with('success', 'Product berhasil dihapus!');
    }
}
