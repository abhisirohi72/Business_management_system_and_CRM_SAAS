<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = DB::transaction(function () use ($data) {

            $company = Company::create([
                'name' => $data['company_name'],
                'email' => $data['company_email'] ?? null,
                'phone' => $data['company_phone'] ?? null,
            ]);

            $developerRole = Role::firstOrCreate(
                [
                    'company_id' => $company->id,
                    'slug' => 'developer',
                ],
                [
                    'name' => 'Developer',
                ]
            );

            return User::create([
                'company_id' => $company->id,
                'role_id' => $developerRole->id,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        });

        Auth::login($user);

        return redirect()->route("dashboard");
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
