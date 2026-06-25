<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PraktijkmanagementController extends Controller
{
    public function index()
    {
        return view('praktijkmanagement.index');
    }

    public function manageUserroles()
    {
        $users = User::sp_GetAllUsers();
        $praktijkmanagementId = auth()->user()->id;

        return view('praktijkmanagement.userroles', compact('users', 'praktijkmanagementId'));
    }

    public function show(User $user)
    {
        $storedUser = User::sp_GetUserById($user->id);
        $user = $storedUser ?? $user;

        return view('praktijkmanagement.show', compact('user'));
    }

    public function edit(User $user)
    {
        $storedUser = User::sp_GetUserById($user->id);
        $user = $storedUser ?? $user;

        $roles = [
            'patient' => __('Patiënt'),
            'mondhygienist' => __('Mondhygiënist'),
            'assistent' => __('Assistent'),
            'tandarts' => __('Tandarts'),
            'praktijkmanagement' => __('Praktijkmanagement'),
        ];

        return view('praktijkmanagement.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->id === auth()->user()->id) {
            return redirect()->route('praktijkmanagement.userroles')->with('error', __('Je kunt je eigen rol niet wijzigen.'));
        }

        $validated = $request->validate([
            'role' => ['required', Rule::in(['patient', 'mondhygienist', 'assistent', 'tandarts', 'praktijkmanagement'])],
        ]);

        $updated = User::sp_UpdateUser($user->id, $validated['role']);

        if (! $updated) {
            return back()->with('error', __('Gebruikersrol kon niet worden bijgewerkt.'))->withInput();
        }

        return redirect()->route('praktijkmanagement.userroles')->with('success', __('Gebruikersrol is bijgewerkt.'));
    }

    public function destroy(string $userId)
    {
        if ((int) $userId === auth()->user()->id) {
            return redirect()->route('praktijkmanagement.userroles')->with('error', __('Je kunt je eigen account niet verwijderen.'));
        }

        $deleted = User::sp_DeleteUser((int) $userId);

        if (! $deleted) {
            return redirect()->route('praktijkmanagement.userroles')->with('error', __('Gebruiker kon niet worden verwijderd.'));
        }

        return redirect()->route('praktijkmanagement.userroles')->with('success', __('Gebruiker is verwijderd.'));
    }
}
