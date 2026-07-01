<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="min-h-screen bg-gray-50">
        <nav class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
                <span class="font-bold text-gray-800">📊 Skripsi</span>
                <div class="flex gap-4">
                    <a href="/" class="text-gray-600 hover:text-gray-900 text-sm">Dashboard</a>
                    <a href="/manage" class="text-gray-600 hover:text-gray-900 text-sm">Manage</a>
                </div>
            </div>
        </nav>

        <div class="py-8">
            @yield('content')
        </div>

        <footer class="text-center text-xs text-gray-400 py-4 border-t">
            © 2026 - Skripsi Management
        </footer>
    </div>
</body>
</html>