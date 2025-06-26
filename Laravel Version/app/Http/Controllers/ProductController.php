<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')
            ->where('status', 1)
            ->latest()
            ->paginate(12);
            
        return view('products', compact('products'));
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        
        if (!$product->status) {
            abort(404);
        }
        
        // Get related products from the same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->inStock()
            ->take(4)
            ->get();
            
        return view('product', compact('product', 'relatedProducts'));
    }

    /**
     * Filter products by price range.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $categoryId = $request->input('category_id');
        
        $query = Product::with('category')
            ->where('status', 1);
            
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        
        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }
        
        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }
        
        $products = $query->paginate(12);
        
        // Get all categories for the filter sidebar
        $categories = Category::where('status', 1)->get();
        
        return view('products', compact('products', 'categories', 'minPrice', 'maxPrice', 'categoryId'));
    }

    /**
     * Sort products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request)
    {
        $sort = $request->input('sort', 'newest');
        $categoryId = $request->input('category_id');
        
        $query = Product::with('category')
            ->where('status', 1);
            
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        
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
        
        // Get all categories for the filter sidebar
        $categories = Category::where('status', 1)->get();
        
        return view('products', compact('products', 'categories', 'sort', 'categoryId'));
    }

    /**
     * Search for products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $products = Product::with('category')
            ->where('status', 1)
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(12);
            
        return view('search', compact('products', 'query'));
    }
}