<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function admin()
    {
        // Check if the user is authenticated and has an admin role
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('admin.home');
        }

        // Redirect to login with an error message
        return redirect()->route('login')->with('error', 'Unauthorized access');
    }

}
