<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);

        $totalProducts = Product::count();
        $outOfStock = Product::where('stock', 0)->count();
        $lowStock = Product::where('stock', '<', 5)->count(); // misalnya stok kurang dari 5 dianggap menipis
        $availableProducts = Product::where('stock', '>', 0)->count();

    return view('products.index', compact(
        'products',
        'totalProducts',
        'outOfStock',
        'lowStock',
        'availableProducts'
    ));

        $products = Product::with('category')->latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'nullable',
            'category_id'=>'required|exists:categories,id',
            'price'=>'required|numeric',
            'stock'=>'required|integer',    
            'photo'=>'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if($request->hasFile('photo')){
            $data['photo'] = $request->file('photo')->store('products','public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success','Product berhasil dibuat!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'nullable',
            'category_id'=>'required|exists:categories,id',
            'price'=>'required|numeric',
            'stock'=>'required|integer',    
            'photo'=>'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if($request->hasFile('photo')){
            if($product->photo){
                Storage::disk('public')->delete($product->photo);
            }
            $data['photo'] = $request->file('photo')->store('products','public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success','Product berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        if($product->photo){
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success','Product berhasil dihapus!');
    }
}
