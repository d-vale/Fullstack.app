<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Crisis Management Simulator') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --secondary: #0f172a;
            --accent: #f97316;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --bg-dark: #0f172a;
            --bg-light: #f8fafc;
            --text-light: #f8fafc;
            --text-dark: #1e293b;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.5;
        }

        .auth-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        .auth-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
        }

        .auth-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary);
            margin-top: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .auth-button {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.5px;
        }

        .auth-button:hover {
            background-color: var(--primary-light);
        }

        .auth-link {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }

        .auth-link:hover {
            color: var(--primary-light);
            text-decoration: underline;
        }

        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            margin-bottom: 1rem;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
        }

        .error-message {
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: -0.5rem;
            margin-bottom: 1rem;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: var(--bg-dark);
                color: var(--text-light);
            }

            .auth-card {
                background-color: #1a202c;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .form-label,
            .auth-title {
                color: var(--text-light);
            }

            .form-input {
                background-color: #2d3748;
                border-color: #4a5568;
                color: var(--text-light);
            }

            .form-input:focus {
                border-color: var(--primary-light);
            }
        }

        @media (max-width: 640px) {
            .auth-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-8">
        <div class="auth-header">
            <a href="/">
                <x-application-logo class="w-20 h-20" />
            </a>
            <h1 class="auth-title">Simulation Center</h1>
        </div>

        <div class="w-full max-w-md auth-card">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
