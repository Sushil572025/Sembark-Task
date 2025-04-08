<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener - @yield('title')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .header {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        .nav {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: right;
        }

        .nav a,
        .nav form {
            display: inline;
            margin-left: 15px;
        }

        .nav button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .nav button:hover {
            background-color: #c82333;
        }

        .content {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>URL Shortener</h2>
    </div>
    <div class="nav">
        @if (auth()->check())
            <span>Welcome, {{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endif
    </div>
    <div class="content">
        @if (session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="message error">{{ $errors->first() }}</div>
        @endif
        @yield('content')
    </div>
</body>

</html>
