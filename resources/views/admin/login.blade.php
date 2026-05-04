<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Nicoville</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #15211d;
            --muted: #6f7d78;
            --line: #dbe6e0;
            --green: #0f6f4d;
            --green-dark: #073f31;
            --coral: #c9543d;
            --paper: #f8f5ee;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            display: grid;
            min-height: 100vh;
            margin: 0;
            place-items: center;
            color: var(--ink);
            font-family: 'Poppins', Arial, Helvetica, sans-serif;
            font-size: 16px;
            background:
                linear-gradient(rgba(7, 63, 49, .82), rgba(7, 63, 49, .72)),
                url('https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=1800&q=80');
            background-position: center;
            background-size: cover;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .login-card {
            width: min(430px, calc(100% - 36px));
            padding: 30px;
            border-radius: 0;
            background: var(--white);
            box-shadow: 0 24px 70px rgba(7, 63, 49, .3);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
        }

        .brand-mark {
            display: grid;
            width: 44px;
            height: 44px;
            place-items: center;
            border-radius: 0;
            color: var(--white);
            background: var(--green);
            font-size: 21px;
            font-weight: 900;
        }

        h1 {
            margin: 0;
            font-size: 30px;
            line-height: 1.1;
        }

        .subtitle {
            margin: 10px 0 24px;
            color: var(--muted);
            line-height: 1.5;
        }

        .field {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            min-height: 46px;
            padding: 0 12px;
            border: 1px solid var(--line);
            border-radius: 0;
            color: var(--ink);
            background: #fbfcfa;
            font: inherit;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 4px 0 20px;
            color: var(--muted);
            font-weight: 700;
        }

        .error {
            margin-bottom: 16px;
            padding: 12px;
            border: 1px solid rgba(201, 84, 61, .28);
            border-radius: 0;
            color: #8f2e1e;
            background: rgba(201, 84, 61, .09);
            font-size: 14px;
        }

        .login-button {
            width: 100%;
            min-height: 50px;
            border: 0;
            border-radius: 0;
            color: var(--white);
            background: var(--coral);
            font-size: 15px;
            font-weight: 900;
            cursor: pointer;
        }

        .back-link {
            display: inline-block;
            margin-top: 18px;
            color: var(--green-dark);
            font-weight: 800;
        }
    </style>
</head>
<body>
    <main class="login-card">
        <a class="brand" href="/">
            <span class="brand-mark">N</span>
            <span>
                <strong>Nicoville</strong><br>
                <span>Admin Panel</span>
            </span>
        </a>

        <h1>Admin Login</h1>
        <p class="subtitle">Sign in to update the homepage hero slider content.</p>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/admin/login">
            @csrf

            <div class="field">
                <label for="email">Email Address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required>
            </div>

            <label class="remember">
                <input name="remember" type="checkbox" value="1">
                Remember me
            </label>

            <button class="login-button" type="submit">Login to Admin</button>
        </form>

        <a class="back-link" href="/">Back to website</a>
    </main>
</body>
</html>
