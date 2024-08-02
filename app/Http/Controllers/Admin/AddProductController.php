<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Category;


class AddProductController extends Controller
{
        public function view()
        {
            $categories = Category::all();

            // Check if the user is authenticated and has an admin role
            if (Auth::check() && Auth::user()->role == 'admin') {
                return view('admin.addproduct', compact('categories'));
            }

            // Redirect to login with an error message
            return redirect()->route('login')->with('error', 'Unauthorized access');
        }

        public function store(Request $request)
        {
            // Validate the form input
            $validated = $request->validate([
                'product_name' => 'required|string|max:255',
                'product_code' => 'required|string|max:255|unique:products',
                'category_id' => 'required|exists:categories,id',
                'product_price' => 'required|numeric|min:0',
                'product_discount' => 'nullable|numeric|min:0',
                'product_weight' => 'required|numeric|min:0',
                'main_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'additional_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'description' => 'required|string',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string',
                'is_featured' => 'nullable',
                'status' => 'required|in:active,inactive',
            ]);

          // Handle file uploads
          if ($request->hasFile('main_image')) {
                $uploadCloudinary = cloudinary()->upload(
                    $request->file('main_image')->getRealPath(),
                    [
                        'folder' => 'fresh/product_images',
                        'resource_type' => 'auto',
                        'transformation' => [
                            'quality' => 'auto',
                            'fetch_format' => 'auto',
                        ]
                    ]
                );
                $mainImagePath = $uploadCloudinary->getSecurePath();
        } else {
            return redirect()->back()->with('status', 'image Must be Uploaded');
        }
          
          // Handle file uploads
          if ($request->hasFile('additional_images')) {
                $uploadCloudinary = cloudinary()->upload(
                    $request->file('additional_images')->getRealPath(),
                    [
                        'folder' => 'fresh/products_additional',
                        'resource_type' => 'auto',
                        'transformation' => [
                            'quality' => 'auto',
                            'fetch_format' => 'auto',
                        ]
                    ]
                );
                $additionalImagesPaths = $uploadCloudinary->getSecurePath();
        } else {
             $additionalImagesPaths = "No file uploaded";
        }

            // Create a new product
            Product::create([
                'product_name' => $validated['product_name'],
                'product_code' => $validated['product_code'],
                'category_id' => $validated['category_id'],
                'product_price' => $validated['product_price'],
                'product_discount' => $validated['product_discount'],
                'product_weight' => $validated['product_weight'],
                'main_image' => $mainImagePath,
                'additional_images' => $additionalImagesPaths,
                'description' => $validated['description'],
                'meta_title' => $validated['meta_title'],
                'meta_description' => $validated['meta_description'],
                'meta_keywords' => $validated['meta_keywords'],
                'is_featured' => $validated['is_featured'] ?? false,
                'status' => $validated['status'],
            ]);

            return redirect()->to(url('adminProduct'))->with('success', 'Product added successfully.');
        }

    // Delete Category
    public function delete($id){
        Product::where('id', $id)->delete();
       return redirect()->to('adminProduct')->with('success', 'Product Deleted successfully.');
    }

}
