@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard</h2>
    @if (auth()->user()->hasRole('SuperAdmin'))
        <h3>Super Admin Panel</h3>
        <div class="form-group">
            <form action="{{ route('invite') }}" method="POST">
                @csrf
                <label for="email">Invite User Email</label>
                <input type="email" name="email" id="email" required>
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="Admin">Admin</option>
                </select>
                <button type="submit">Send Invitation</button>
            </form>
        </div>
        <div class="form-group" style="margin-top: 20px;">
            <a href="{{ route('client') }}"
                style="display: inline-block; width: auto; text-decoration: none; padding: 8px 15px; background-color: #007BFF; color: white; border-radius: 4px;">
                View All Clients
            </a>
        </div>
        <div class="form-group" style="margin-top: 20px;">
            <a href="{{ route('short-urls.index') }}"
                style="display: inline-block; width: auto; text-decoration: none; padding: 8px 15px; background-color: #007BFF; color: white; border-radius: 4px;">
                View All Short URLs
            </a>
        </div>
    @elseif (auth()->user()->hasRole('Admin'))
        <h3>Admin Panel</h3>
        <div class="form-group">
            <form action="{{ route('invite') }}" method="POST">
                @csrf
                <label for="email">Invite User Email</label>
                <input type="email" name="email" id="email" required>
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="Admin">Admin</option>
                    <option value="Member">Member</option>
                </select>
                <button type="submit">Send Invitation</button>
            </form>
        </div>
        <div class="form-group">
            <form action="{{ route('short-urls.store') }}" method="POST">
                @csrf
                <label for="original_url">Original URL</label>
                <input type="url" name="original_url" id="original_url" placeholder="Enter URL" required>
                <button type="submit">Generate Short URL</button>
            </form>
        </div>
        <div class="form-group" style="margin-top: 20px;">
            <a href="{{ route('client') }}"
                style="display: inline-block; width: auto; text-decoration: none; padding: 8px 15px; background-color: #007BFF; color: white; border-radius: 4px;">
                View Company Member
            </a>
        </div>
        <div class="form-group" style="margin-top: 20px;">
            <a href="{{ route('short-urls.index') }}"
                style="display: inline-block; width: auto; text-decoration: none; padding: 8px 15px; background-color: #007BFF; color: white; border-radius: 4px;">
                View Company Short URLs
            </a>
        </div>
    @else
        <h3>Member Panel</h3>
        <div class="form-group">
            <form action="{{ route('short-urls.store') }}" method="POST">
                @csrf
                <label for="original_url">Original URL</label>
                <input type="url" name="original_url" id="original_url" placeholder="Enter URL" required>
                <button type="submit">Generate Short URL</button>
            </form>
        </div>
        <div class="form-group" style="margin-top: 20px;">
            <a href="{{ route('short-urls.index') }}"
                style="display: inline-block; width: auto; text-decoration: none; padding: 8px 15px; background-color: #007BFF; color: white; border-radius: 4px;">
                View My Short URLs
            </a>
        </div>
    @endif
@endsection
