<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . uniqid($image->getClientOriginalName()) . '-' . $image->getClientOriginalName();
            $imagePath = 'uploads/categories/' . $fileName;
            $image->move(public_path('uploads/categories'), $fileName);
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_url' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $category->image_url;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . uniqid($image->getClientOriginalName()) . '-' . $image->getClientOriginalName();
            $imagePath = 'uploads/categories/' . $fileName;
            $image->move(public_path('uploads/categories'), $fileName);
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Delete image file if exists
        if ($category->image_url && file_exists(public_path($category->image_url))) {
            unlink(public_path($category->image_url));
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
