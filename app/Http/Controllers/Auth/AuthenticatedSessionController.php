<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    
    public function create(): View
    {
        return view('auth.login');
    }

    
    /* public function store(Request $request)
{
    $credentials = $request->validate([
        'email'    => ['required','string','email'],
        'password' => ['required','string'],
    ]);

    if (! Auth::attempt($credentials, $request->boolean('remember'))) {
        return back()->withErrors(['email' => __('auth.failed')])->onlyInput('email');
    }

    $request->session()->regenerate();
    
    $request->session()->forget('url.intended');

    $user = Auth::user();

    $target = $user->user_type === 'admin'
        ? route('admin.dashboard')
        : route('dashboard');

    return redirect()->to($target); 
} */
    
    public function destroy(Request $request): RedirectResponse
        {
            Auth::guard('web')->logout(); // Cierra sesión del usuario actual (sea admin o empresa)

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }

            public function store(Request $request)
        {
        $credentials = $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => __('auth.failed')])->onlyInput('email');
        }

        $request->session()->regenerate();

        // ⚠️ Evitar redirección "intended"
        $request->session()->remove('url.intended');

        $user = Auth::user();

        // 🔹 Redirección según tipo de usuario
        switch ($user->user_type) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'recolector': // 👈 aquí está el cambio clave
                return redirect()->route('company.dashboard');
            default:
                return redirect()->route('user.dashboard');
        }
    }



}
