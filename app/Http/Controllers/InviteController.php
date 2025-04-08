<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class InviteController extends Controller
{
    public function invite(Request $request)
    {
        $user = auth()->user();
        if (!$user->hasPermissionTo('invite-user')) {
            return redirect()->back()->with('error', 'You do not have permission to invite users.');
        }

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:Admin,Member',
        ]);

        $company = $user->hasRole('SuperAdmin') ? Company::create(['name' => $request->email]) : $user->company;

        // Restrict SuperAdmin to only invite Admins
        if ($user->hasRole('SuperAdmin') && $request->role === 'Member') {
            return redirect()->back()->with('error', 'SuperAdmin can only invite Admins.');
        }

        $newUser = User::create([
            'name' => $request->email,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'company_id' => $company->id,
        ]);
        $newUser->assignRole($request->role);

        if ($user->hasRole('Admin')) {
            $newUser->givePermissionTo('create-short-url');
            $newUser->givePermissionTo('view-company-short-urls');
        } elseif ($user->hasRole('SuperAdmin')) {
            $newUser->givePermissionTo('invite-user');
        }

        return redirect()->back()->with('success', 'User invited successfully.');
    }
}
