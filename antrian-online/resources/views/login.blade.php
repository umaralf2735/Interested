<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Antrian Online</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366F1;
            --primary-hover: #4F46E5;
            --bg: #0F172A; /* Slate 900 */
            --card-bg: #1E293B; /* Slate 800 */
            --text-dark: #F8FAFC; /* Slate 50 */
            --text-gray: #94A3B8; /* Slate 400 */
            --border: #334155; /* Slate 700 */
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-card {
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: var(--shadow-lg);
            width: 100%;
            max-width: 400px;
            border: 1px solid var(--border);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }
        
        .login-header p {
            color: var(--text-gray);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-gray);
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid var(--border);
            background: var(--bg);
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            border-color: var(--primary);
        }

        .btn-login {
            width: 100%;
            padding: 0.75rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 1rem;
        }

        .btn-login:hover {
            background: var(--primary-hover);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            color: #FCA5A5;
            padding: 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-gray);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.2s;
        }
        
        .back-link:hover {
            color: var(--text-dark);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <h1>Login Admin</h1>
            <p>Silakan masuk untuk mengelola antrian.</p>
        </div>

        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@admin.com">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>
        
        <a href="{{ route('home') }}" class="back-link">&larr; Kembali ke Publik</a>
    </div>

</body>
</html>
