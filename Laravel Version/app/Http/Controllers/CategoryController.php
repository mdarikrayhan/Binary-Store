<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status', 1)->paginate(12);
        return view('categories', compact('categories'));
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        
        if (!$category->status) {
            abort(404);
        }
        
        $products = Product::where('category_id', $category->id)
            ->where('status', 1)
            ->paginate(12);
            
        return view('category', compact('category', 'products'));
    }

    /**
     * Filter products by price range within a category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        if (!$category->status) {
            abort(404);
        }
        
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        
        $query = Product::where('category_id', $category->id)
            ->where('status', 1);
            
        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }
        
        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }
        
        $products = $query->paginate(12);
        
        return view('category', compact('category', 'products', 'minPrice', 'maxPrice'));
    }

    /**
     * Sort products within a category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        if (!$category->status) {
            abort(404);
        }
        
        $sort = $request->input('sort', 'newest');
        
        $query = Product::where('category_id', $category->id)
            ->where('status', 1);
            
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }
        
        $products = $query->paginate(12);
        
        return view('category', compact('category', 'products', 'sort'));
    }
}