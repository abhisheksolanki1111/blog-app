<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->latest()->paginate(10);
        return view('subcategories.index', ['title' => 'List Subcategories', 'subcategories' => $subcategories]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('subcategories.create', ['title' => 'Create Subcategories', 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        // Check if subcategory name is unique within the category
        $exists = Subcategory::where('name', $request->name)
            ->where('category_id', $request->category_id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Subcategory name must be unique within the selected category.');
        }

        Subcategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully.');
    }

    public function show(Subcategory $subcategory)
    {
        return view('subcategories.show', ['title' => 'Details Subcategory', 'subcategory' => $subcategory]);
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('subcategories.edit',[
            'title' => 'Edit Subcategory',
            'subcategory' => $subcategory,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        // Check if subcategory name is unique within the category (excluding current subcategory)
        $exists = Subcategory::where('name', $request->name)
            ->where('category_id', $request->category_id)
            ->where('id', '!=', $subcategory->id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Subcategory name must be unique within the selected category.');
        }

        $subcategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }

    public function getByCategory(Request $request)
    {
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        return response()->json($subcategories);
    }
}
