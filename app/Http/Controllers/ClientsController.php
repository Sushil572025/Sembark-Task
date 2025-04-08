<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $companies = [];

        if ($user->hasRole('SuperAdmin')) {
            $companies = Company::withCount('users')->get();
        } else {
            $companies = Company::where('id', $user->company_id)->withCount('users')->get();
        }

        return view('clients.index', compact('companies'));
    }
}
