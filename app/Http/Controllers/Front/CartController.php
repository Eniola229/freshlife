<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
     /**
     * Add a product to the cart.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $userId = Auth::id();

        // Check if the product is already in the cart
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Update the quantity if the item is already in the cart
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Add a new item to the cart
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Display the user's cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCart()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        return view('cart', compact('cartItems'));
    }


    /**
     * Delete the user's cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        Cart::where('id', $id)->delete();
       return redirect()->to('cart')->with('success', 'Cart Deleted successfully.');
    }
}
