<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;


class UserController extends Controller
{
        public function view()
      { 

        $products = Cache::remember('product' . request()->get('page', 1), 60, function () {
                return Product::orderBy('created_at', 'desc')
                    ->paginate(16, ['*'], 'products');
        });
        $categories = Category::all();

         return view('product', compact('categories', 'products')); 
      }

      public function productDetails($id) {
        // Fetch the product with caching
        $product = Cache::remember("product:{$id}", 60, function () use ($id) {
            return Product::where('id', $id)->first();
        });

        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Oops Something went wrong');
        }

        // Fetch the product category efficiently
        $category = Category::find($product->category_id);
        // Pass the data to the view
        return view('productDetails', compact('product', 'category'));
      }

}
