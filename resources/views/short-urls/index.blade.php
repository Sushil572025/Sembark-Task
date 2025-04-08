@extends('layouts.app')

@section('title', 'Short URLs')

@section('content')
    <h2>Short URLs</h2>

    @php
        $shortUrls = [];
        if (auth()->user()->hasRole('SuperAdmin')) {
            $shortUrls = \App\Models\ShortUrl::all();
            $count = \App\Models\ShortUrl::count();
        } elseif (auth()->user()->hasRole('Admin')) {
            $shortUrls = auth()->user()->company->shortUrls;
            $count = auth()->user()->company->shortUrls()->count();
        } else {
            $shortUrls = auth()->user()->shortUrls;
            $count = auth()->user()->shortUrls()->count();
        }
    @endphp

    <p>Total Short URLs: {{ $count }}</p>

    @if ($shortUrls->isEmpty())
        <p>No short URLs available.</p>
    @else
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #007BFF; color: white;">
                    <th style="padding: 10px; border: 1px solid #ddd;">Original URL</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Short URL</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shortUrls as $shortUrl)
                    <tr style="border: 1px solid #ddd;">
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $shortUrl->original_url }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <a href="{{ route('short-url.redirect', $shortUrl->short_code) }}" target="_blank">
                                {{ route('short-url.redirect', $shortUrl->short_code) }}
                            </a>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $shortUrl->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="form-group" style="margin-top: 20px;">
        <a href="{{ route('dashboard') }}"
            style="display: inline-block; width: auto; text-decoration: none; padding: 8px 15px; background-color: #6c757d; color: white; border-radius: 4px;">
            Back to Dashboard
        </a>
    </div>
@endsection
