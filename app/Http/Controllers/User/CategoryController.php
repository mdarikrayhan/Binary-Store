<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('user')->get();
        return view('user.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::with('user')->findOrFail($id);
        $products = Product::where('category_id', $id)->with('category')->get();
        return view('user.categories.show', compact('category', 'products'));
    }
}
