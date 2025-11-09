<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full text-center space-y-8">
            <!-- Logo or App Name -->
            <div>
                <h1 class="text-5xl font-bold text-gray-900 mb-2">CRM System</h1>

            </div>

            <!-- Buttons -->
            <div class="space-y-4 pt-8">
                @auth
                    <a href="{{ url('/dashboard') }}" 
                       class="block w-full py-3 px-6 text-center text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition duration-150 shadow-md">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="block w-full py-3 px-6 text-center text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition duration-150 shadow-md">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="block w-full py-3 px-6 text-center text-blue-600 bg-white border-2 border-blue-600 hover:bg-blue-50 rounded-lg font-semibold transition duration-150">
                            Register
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Footer text (optional) -->
            <div class="pt-8">
                <p class="text-sm text-gray-500">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </p>
            </div>
        </div>
    </div>
</body>
</html>