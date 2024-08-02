<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Import Str class
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'bussnessPhoto' => ['required', 'image', 'max:2048'],
            'firstName' => ['required', 'string', 'max:155'],
            'lastName' => ['required', 'string', 'max:155'],
            'bussinessName' => ['required', 'string', 'max:255'],
            'mobileOne' => ['required', 'string', 'max:15'],
            'mobileTwo' => ['required', 'string', 'max:15'],
            'location' => ['required', 'string', 'max:155'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Function to generate a unique ID
        $generateUniqueId = function($name) {
            $prefix = strtoupper(Str::random(2)); // Random 2-letter prefix
            $slug = Str::slug($name); // Slug from the name
            
            // Format the unique ID
            return sprintf('@%s_%s', $prefix, $slug);
        };
                // Generate the unique ID
        $uniqueId = $generateUniqueId($request->bussinessName);

        // Handle attachment upload and resizing
          if ($request->hasFile('bussnessPhoto')) {
                $uploadCloudinary = cloudinary()->upload(
                    $request->file('bussnessPhoto')->getRealPath(),
                    [
                        'folder' => 'fresh/bussinessPhotos',
                        'resource_type' => 'auto',
                        'transformation' => [
                            'quality' => 'auto',
                            'fetch_format' => 'auto',
                        ]
                    ]
                );
                $bussnessPhotoPath = $uploadCloudinary->getSecurePath();
        } else {
            return redirect()->back()->with('status', 'Attachments Must be Uploaded');
        }


        $user = User::create([
            'image_url' => $bussnessPhotoPath,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'bussinessName' => $request->bussinessName,
            'mobileOne' => $request->mobileOne,
            'mobileTwo' => $request->mobileTwo,
            'location' => $request->location,
            'uniqueID' => $uniqueId, // Pass the generated unique ID here
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
