<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Library</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; margin: 0; padding: 0; }
        body { background-color: #f4f6f9; color: #333; }
        .header { background-color: #2b4162; color: white; padding: 20px; font-size: 20px; font-weight: bold; }
        .container { max-width: 400px; margin: 30px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { font-size: 18px; margin-bottom: 15px; }
        label { display: block; font-size: 14px; margin-bottom: 5px; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; }
        .btn { width: 100%; padding: 10px; background-color: #2b4162; color: white; border: none; border-radius: 4px; font-size: 14px; cursor: pointer; }
        .btn:hover { background-color: #1e304a; }
        .alert-error { background-color: #fdecea; color: #b71c1c; border: 1px solid #f5c6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">Digital Library Laravel</div>
    <div class="container">
        <h2>Login</h2>

        @error('email')
            <div class="alert-error">{{ $message }}</div>
        @enderror

        <form method="POST" action="{{ route('login.process') }}">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn">Masuk</button>
        </form>
    </div>
</body>
</html>