<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Digital Library - Fasilitas &amp; Area</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            color: #222222;
        }

        header.app-header {
            background-color: #2c3e50;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        header.app-header h1 {
            margin: 0;
            font-size: 28px;
        }
        .user-bar {
            margin-top: 10px;
            font-size: 14px;
        }
        .user-bar .role-badge {
            background-color: #ffffff;
            color: #2c3e50;
            font-weight: bold;
            padding: 2px 8px;
            border-radius: 4px;
            margin: 0 8px 0 4px;
        }

        main.app-main {
            max-width: 900px;
            margin: 20px auto;
            padding: 0 20px;
        }
        main.app-main h2 {
            color: #2c3e50;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }

        .btn-primary, .btn-success {
            background-color: #2c3e50;
            border-color: #2c3e50;
        }
        .btn-primary:hover, .btn-success:hover {
            background-color: #1f2d3a;
            border-color: #1f2d3a;
        }

        .table-dark {
            --bs-table-bg: #2c3e50;
            --bs-table-border-color: #2c3e50;
        }
        .table, .card {
            border-color: #cccccc;
            border-radius: 6px;
        }

        .status-tersedia {
            color: #1e7e34;
            font-weight: bold;
        }
        .status-terisi {
            color: #c0392b;
            font-weight: bold;
        }

        footer.app-footer {
            background-color: #2c3e50;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
        }
        footer.app-footer p {
            margin: 4px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>

<header class="app-header navbar-header">
    <h1>Digital Library</h1>
    @auth
    <div class="user-bar">
        {{ auth()->user()->name }}
        <span class="role-badge">{{ ucfirst(auth()->user()->role) }}</span>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-outline-light">Logout</button>
        </form>
    </div>
    @endauth
</header>

<main class="app-main">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>

<footer class="app-footer">
    <p>Nama: Marcel Aziz</p>
    <p>NIM: 102022500231</p>
    <p>Kelas: SI4906</p>
    <p>Kelompok: Kelompok 1</p>
    <p>Modul: Fasilitas &amp; Area</p>
</footer>

</body>
</html>