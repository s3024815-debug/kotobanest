<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function show(Request $request): View
    {
        return view('student.account.show', ['user' => $request->user()]);
    }

    public function edit(Request $request): View
    {
        return view('student.account.edit', ['user' => $request->user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'alpha_dash', 'max:50', Rule::unique('users')->ignore($user->id)],
            'country' => ['nullable', 'string', 'max:100'],
            'native_language' => ['nullable', 'string', 'max:100'],
            'current_jlpt' => ['required', 'in:N5,N4,N3,N2,N1'],
            'bio' => ['nullable', 'string', 'max:500'],
        ]);

        $user->update($validated);

        return redirect()->route('account.show')->with('success', 'Profile updated.');
    }
}
