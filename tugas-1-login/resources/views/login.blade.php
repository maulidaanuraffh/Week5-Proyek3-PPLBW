<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: sans-serif; max-width: 400px; margin: 60px auto; padding: 0 1rem; }
        h1 { margin-bottom: 0.25rem; }
        p.subtitle { color: #666; margin-top: 0; }
        .error { color: red; background: #fff0f0; border: 1px solid #fcc; padding: 0.5rem 0.75rem; border-radius: 4px; }
        label { display: block; margin-top: 1rem; margin-bottom: 0.25rem; font-weight: bold; }
        input[type=text], input[type=password] { width: 100%; padding: 0.5rem; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { margin-top: 1.25rem; padding: 0.5rem 1.5rem; background: #1a57a0; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #154a8a; }
    </style>
</head>
<body>
    <h1>Login</h1>
    <p class="subtitle">Masuk untuk membuka dashboard</p>

    @if (session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="username">Username</label>
        <input type="text" id="username" name="username"
               value="{{ old('username') }}" required autofocus>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Masuk</button>
    </form>
</body>
</html>