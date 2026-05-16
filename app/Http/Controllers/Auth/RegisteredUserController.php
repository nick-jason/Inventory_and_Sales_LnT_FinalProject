<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'min:6', 'max:12', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required', 'string', 'starts_with:08', 'min:10', 'max:13'],
        ]);
        
        $address = $postal_code = null;

        $user = User::create([
            'name' => $request->name,
            'admin_id' => null,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'address' => $address,
            'postal_code' => $postal_code,
        ]);

        event(new Registered($user));

        Auth::login($user);

        if(auth()->user()->role === 'admin'){
            return redirect()->route('adminPage');
        }
        else{
            return redirect()->route('userPage');
        }
    }
}
