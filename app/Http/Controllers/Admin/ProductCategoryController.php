<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


class ProductCategoryController extends Controller
{
    public function view()
      { 
            $categories = Category::all();
            // Check if the user is authenticated and has an admin role
            if (Auth::check() && Auth::user()->role == 'admin') {
                return view('admin.category', compact('categories')); 
            }

            // Redirect to login with an error message
            return redirect()->route('login')->with('error', 'Unauthorized access');
      }

    // Store a newly created category in storage
    public function store(Request $request)
    {
        // Validate the form input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // Create a new category
        Category::create([
            'name' => $validated['name'],
        ]);

        // Redirect to the categories list with a success message
        return redirect()->to('adminProduct')->with('success', 'Category added successfully.');
    }

    // Delete Category
    public function delete($id){
        Category::where('id', $id)->delete();
       return redirect()->to('adminProduct')->with('success', 'Category Deleted successfully.');
    }
}
