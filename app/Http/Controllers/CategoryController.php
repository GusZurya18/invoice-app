<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::withCount('products')->get();

        $totalCategories = $categories->count();
        $categoryWithMostProducts = $categories->sortByDesc('products_count')->first();
        $emptyCategories = $categories->where('products_count', 0)->count();

    return view('categories.index', compact(
        'categories',
        'totalCategories',
        'categoryWithMostProducts',
        'emptyCategories'
    ));

        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success','Category berhasil dibuat!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success','Category berhasil diupdate!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success','Category berhasil dihapus!');
    }

    
}
