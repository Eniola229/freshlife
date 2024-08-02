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

        //Update product
        public function update(Request $request, $id)
        {
            // Validate the request
            $request->validate([
                'product_name' => 'required|string|max:255',
                'product_code' => 'required|string|max:255',
                'main_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'additional_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'product_price' => 'required|numeric',
                'product_discount' => 'nullable|numeric',
                'product_weight' => 'nullable|numeric',
                'description' => 'nullable|string',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:255',
                'meta_keywords' => 'nullable|string|max:255',
                'is_featured' => 'nullable|boolean',
                'status' => 'required|boolean',
            ]);

            $product = Product::findOrFail($id);

            // Handle main image upload
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
                $product->main_image = $uploadCloudinary->getSecurePath();
            }

            // Handle additional images upload
            if ($request->hasFile('additional_images')) {
                $additionalImagesPaths = [];
                foreach ($request->file('additional_images') as $image) {
                    $uploadCloudinary = cloudinary()->upload(
                        $image->getRealPath(),
                        [
                            'folder' => 'fresh/products_additional',
                            'resource_type' => 'auto',
                            'transformation' => [
                                'quality' => 'auto',
                                'fetch_format' => 'auto',
                            ]
                        ]
                    );
                    $additionalImagesPaths[] = $uploadCloudinary->getSecurePath();
                }
                // Assuming `additional_images` is a JSON or array field in your database
                $product->additional_images = json_encode($additionalImagesPaths);
            }

            // Update the product with other fields
            $product->product_name = $request->input('product_name');
            $product->product_code = $request->input('product_code');
            $product->product_price = $request->input('product_price');
            $product->product_discount = $request->input('product_discount');
            $product->product_weight = $request->input('product_weight');
            $product->description = $request->input('description');
            $product->meta_title = $request->input('meta_title');
            $product->meta_description = $request->input('meta_description');
            $product->meta_keywords = $request->input('meta_keywords');
            $product->is_featured = $request->input('is_featured') ? true : false;
            $product->status = $request->input('status');
            
            $product->save();

            return redirect()->to(url('adminProduct'))->with('success', 'Product updated successfully!');
        }

    // Delete Category
    public function delete($id){
        Product::where('id', $id)->delete();
       return redirect()->to('adminProduct')->with('success', 'Product Deleted successfully.');
    }

}
