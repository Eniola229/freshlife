<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function view()
    {

          $products = Cache::remember('admin.product' . request()->get('page', 1), 60, function () {
                return Product::orderBy('created_at', 'desc')
                    ->paginate(16, ['*'], 'products');
          });
        $categories = Category::all();

        // Check if the user is authenticated and has an admin role
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('admin.product', compact('products', 'categories'));
        }

        // Redirect to login with an error message
        return redirect()->route('login')->with('error', 'Unauthorized access');
    }
}
