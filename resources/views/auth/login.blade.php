<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Kelurahan Ledok Kulon</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Assets (Tailwind + Vite) -->
    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="h-full flex items-center justify-center p-4 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-slate-900 via-slate-950 to-black">

    <div class="w-full max-w-md">
        <!-- Logo Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-tr from-indigo-500 to-indigo-600 flex items-center justify-center font-extrabold text-white shadow-xl text-3xl shadow-indigo-600/30">
                L
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-white">Sistem Administrasi Desa</h1>
            <p class="text-sm text-slate-400 mt-1.5">Kelurahan Ledok Kulon, Kecamatan Bojonegoro</p>
        </div>

        <!-- Login Card -->
        <div class="bg-slate-900/50 backdrop-blur-xl border border-slate-800 rounded-3xl p-8 shadow-2xl">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-white">Masuk sebagai Perangkat Desa</h2>
                <p class="text-xs text-slate-400 mt-1">Gunakan kredensial admin Anda untuk melanjutkan.</p>
            </div>

            <!-- Toast-like validation errors or flash status -->
            @if (session('success'))
                <div class="mb-4 p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3.5 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-medium">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Alamat Email</label>
                    <div class="relative">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="nama@desa.com"
                            class="w-full px-4 py-3 bg-slate-950/80 border border-slate-800 rounded-xl text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder:text-slate-600 transition-all">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required placeholder="••••••••"
                            class="w-full px-4 py-3 bg-slate-950/80 border border-slate-800 rounded-xl text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder:text-slate-600 transition-all">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded bg-slate-950 border-slate-800 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-slate-900 focus:ring-offset-2">
                        <label for="remember" class="ml-2 text-xs font-medium text-slate-400 select-none">Ingat saya</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl text-sm transition-all focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-900 shadow-lg shadow-indigo-600/25">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>

        <div class="text-center mt-8">
            <span class="text-xs text-slate-600">&copy; 2026 Pemerintah Kelurahan Ledok Kulon. All rights reserved.</span>
        </div>
    </div>

</body>
</html>
