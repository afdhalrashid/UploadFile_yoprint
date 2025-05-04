
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'My App' }}</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen font-sans antialiased text-gray-800">
    <header class="bg-white shadow p-4">
        <div class="container m-8">
            <div class="max-w-7xl mx-auto flex justify-between items-center py-5">
                <h1 class="text-xl font-bold">📁 File Uploader</h1>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto mt-8 p-6 bg-white rounded shadow">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
