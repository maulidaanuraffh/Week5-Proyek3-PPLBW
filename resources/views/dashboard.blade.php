<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; margin: 0; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 1.5rem; background: #1a57a0; color: white; }
        header span { font-weight: bold; font-size: 1.1rem; }
        header button { background: white; color: #1a57a0; border: none; padding: 0.4rem 1rem; border-radius: 4px; cursor: pointer; font-weight: bold; }
        header button:hover { background: #e8f0fe; }
        main { padding: 2rem 1.5rem; max-width: 700px; }
    </style>
</head>
<body>
    <header>
        <span>Dashboard</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </header>

    <main>
        <h1>Selamat datang, {{ Auth::user()->nama_lengkap }}!</h1>
        <p>Halaman ini hanya bisa dibuka setelah login.</p>
        <p>Username: <strong>{{ Auth::user()->username }}</strong></p>
    </main>
</body>
</html>