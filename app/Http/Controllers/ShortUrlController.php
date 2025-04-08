<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('SuperAdmin')) {
            $shortUrls = ShortUrl::all();
        } elseif ($user->hasRole('Admin')) {
            $shortUrls = $user->company->shortUrls;
        } else {
            $shortUrls = $user->shortUrls;
        }
        return view('short-urls.index', compact('shortUrls'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user->hasPermissionTo('create-short-url')) {
            return redirect()->back()->with('error', 'You do not have permission to create short URLs.');
        }

        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortCode = Str::random(6);
        ShortUrl::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
            'user_id' => $user->id,
            'company_id' => $user->company_id,
        ]);

        return redirect()->back()->with('success', 'Short URL created successfully.');
    }

    public function redirect($shortCode)
    {
        $shortUrl = ShortUrl::where('short_code', $shortCode)->firstOrFail();
        return redirect($shortUrl->original_url);
    }
}
