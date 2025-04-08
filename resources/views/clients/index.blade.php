@extends('layouts.app')

@section('title', 'Clients')

@section('content')
    <h2>Clients</h2>

    @php
        $user = auth()->user();
    @endphp

    @if ($user->hasRole('SuperAdmin'))
        <p>Showing all clients and their total members.</p>
    @else
        <p>Showing your company and its total members.</p>
    @endif

    @if ($companies->isEmpty())
        <p>No clients available.</p>
    @else
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #007BFF; color: white;">
                    <th style="padding: 10px; border: 1px solid #ddd;">Client Name</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Total Members</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr style="border: 1px solid #ddd;">
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $company->name }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $company->users_count }}</td>
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
