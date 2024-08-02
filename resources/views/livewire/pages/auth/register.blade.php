<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $uniqueID = '';
    public string $firstName = '';
    public string $lastName = '';
    public string $bussinessName = '';
    public string $mobileOne = '';
    public string $mobileTwo = '';
    public string $location = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'firstName' => ['required', 'string', 'max:125'],
            'lastName' => ['required', 'string', 'max:125'],
            'bussinessName' => ['required', 'string', 'max:255'],
            'mobileOne' => ['required', 'string', 'max:25'],
            'mobileTwo' => ['required', 'string', 'max:25'],
            'location' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Define the function to generate a unique ID
        $generateUniqueId = function($name) {
            $prefix = strtoupper(Str::random(2));
            return sprintf('@%s_%s_%s', $prefix, Str::slug($name), Str::uuid()->toString());
        };

        // Generate the unique ID
        $validated['uniqueID'] = $generateUniqueId($validated['bussinessName']);

        // Hash the password
        $validated['password'] = Hash::make($validated['password']);

        // Create the user and trigger the Registered event
        event(new Registered($user = User::create($validated)));

        // Log in the user
        Auth::login($user);

        // Redirect to the dashboard
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('First Name')" />
           <x-text-input wire:model="firstName" id="firstName" class="block mt-1 w-full" type="text" name="firstName" required autofocus autocomplete="firstName" />
            <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="lastName" :value="__('Last Name')" />
            <x-text-input wire:model="lastName" id="lastName" class="block mt-1 w-full" type="text" name="lastName" required autofocus autocomplete="lastName" />
            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="bussinessName" :value="__('Bussiness Name')" />
            <x-text-input wire:model="bussinessName" id="bussinessName" class="block mt-1 w-full" type="text" name="bussinessName" required autofocus autocomplete="bussinessName" />
            <x-input-error :messages="$errors->get('bussinessName')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Numbers -->
        <div class="mt-4">
            <x-input-label for="mobileOne" :value="__('Phone Number 1')" />
            <x-text-input wire:model="mobileOne" id="mobileOne" class="block mt-1 w-full" type="number" name="mobileOne" required autocomplete="username" />
            <x-input-error :messages="$errors->get('mobileOne')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="mobileTwo" :value="__('Phone Number 2')" />
            <x-text-input wire:model="mobileTwo" id="mobileTwo" class="block mt-1 w-full" type="number" name="mobileTwo" required autocomplete="username" />
            <x-input-error :messages="$errors->get('mobileTwo')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="loacation" :value="__('Location')" />
            <x-text-input wire:model="loacation" id="loacation" class="block mt-1 w-full" type="text" name="loacation" required autocomplete="username" />
            <x-input-error :messages="$errors->get('loacation')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
