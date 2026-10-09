<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Online')</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: sans-serif;
            background: #FDF5F5;
            color: #3a2020;
            min-height: 100vh;
        }

        nav {
            background: #6B3A3A;
            padding: 0.85rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav .brand { color: #FDF5F5; font-size: 1.2rem; font-weight: bold; text-decoration: none; }
        nav .nav-links { display: flex; align-items: center; gap: 1rem; }
        nav .nav-links a { color: #F0D5D5; text-decoration: none; font-size: 0.95rem; }
        nav .nav-links a:hover { color: white; text-decoration: underline; }
        nav .btn-nav {
            background: #C4717A;
            color: white;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
        }
        nav .btn-nav:hover { background: #ad5f67; }
        nav .btn-nav-outline {
            background: transparent;
            color: #F0D5D5;
            border: 1.5px solid #F0D5D5;
            padding: 0.35rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
            text-decoration: none;
        }
        nav .btn-nav-outline:hover { background: rgba(240,213,213,0.2); }

        .container { max-width: 960px; margin: 2rem auto; padding: 0 1rem; }

        .alert-success {
            background: #edf7e8;
            border: 1px solid #b6d98a;
            color: #2d6a1f;
            padding: 0.6rem 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        .alert-error {
            background: #fdf0f0;
            border: 1px solid #e8b4b4;
            color: #7a2020;
            padding: 0.6rem 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .btn {
            padding: 0.45rem 1.1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary { background: #C4717A; color: white; }
        .btn-primary:hover { background: #ad5f67; }
        .btn-secondary { background: #6B3A3A; color: white; }
        .btn-secondary:hover { background: #572e2e; }
        .btn-danger { background: #9e3030; color: white; }
        .btn-danger:hover { background: #852828; }
        .btn-outline { background: transparent; color: #C4717A; border: 1.5px solid #C4717A; }
        .btn-outline:hover { background: #C4717A; color: white; }

        table { width: 100%; border-collapse: collapse; background: #F0D5D5; border-radius: 8px; overflow: hidden; }
        th { background: #6B3A3A; color: white; padding: 10px 14px; text-align: left; }
        td { padding: 10px 14px; border-bottom: 1px solid #e0bfbf; color: #3a2020; }
        tr:last-child td { border-bottom: none; }

        .card { background: #F0D5D5; border-radius: 8px; padding: 1.5rem; margin-bottom: 1rem; }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('products.index') }}" class="brand">Toko Online</a>
    <div class="nav-links">
        <a href="{{ route('products.index') }}">Beranda</a>
        @auth
            <a href="{{ route('cart.index') }}">Keranjang ({{ array_sum(array_column(session('keranjang', []), 'jumlah')) }})</a>
            <a href="{{ route('orders.index') }}">Pesanan Saya</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn-nav">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn-nav">Login</a>
            <a href="{{ route('register') }}" class="btn-nav-outline">Daftar</a>
        @endauth
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>