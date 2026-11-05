<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke Panel CMS — Direktori RW & UMKM</title>
    
    <!-- One variable font family; system fonts remain the fallback. -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Subtle Background Accent -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center space-y-3 relative z-10">
        <a href="{{ route('home') }}" class="inline-flex items-center space-x-3 group">
            <div class="w-11 h-11 rounded-xl bg-terracotta text-white flex items-center justify-center font-bold text-xl shadow-md group-hover:scale-105 transition">
                RW
            </div>
            <span class="font-corporate text-2xl font-extrabold text-white tracking-tight">
                Panel CMS
            </span>
        </a>
        <p class="text-xs font-mono text-slate-400 uppercase tracking-wider font-semibold">
            Pengelolaan Profil RW & Direktori UMKM
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        <div class="bg-white py-8 px-6 shadow-2xl rounded-2xl sm:px-10 border border-slate-200 space-y-6 text-slate-900">
            
            <div class="border-b border-slate-100 pb-4">
                <h2 class="text-lg font-corporate font-extrabold text-slate-900">Masuk ke Akun Administrator</h2>
                <p class="text-xs text-slate-500 mt-1 font-normal">Silakan masukkan email dan kata sandi admin Anda.</p>
            </div>

            @if(session('error'))
                <div class="p-3.5 rounded-xl bg-red-50 text-red-800 text-xs border border-red-200">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="p-3.5 rounded-xl bg-red-50 text-red-800 text-xs border border-red-200 space-y-1">
                    @foreach($errors->all() as $err)
                        <p>&bull; {{ $err }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase font-mono tracking-wider">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="masukkan email admin..." required autofocus autocomplete="email" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:outline-none shadow-2xs text-slate-900">
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase font-mono tracking-wider">Kata Sandi</label>
                    <input id="password" type="password" name="password" value="" placeholder="masukkan kata sandi..." required autocomplete="current-password" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:outline-none shadow-2xs text-slate-900">
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-terracotta focus:ring-terracotta">
                        <span class="ml-2 text-xs text-slate-600 font-medium">Ingat sesi saya</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 rounded-xl text-xs font-bold uppercase tracking-wider text-white bg-terracotta hover:bg-terracotta-hover transition shadow-md">
                        Masuk ke Panel CMS
                    </button>
                </div>
            </form>

            <div class="pt-2 text-center border-t border-slate-100">
                <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-slate-900 transition font-semibold inline-flex items-center space-x-1">
                    <span>&larr; Kembali ke Website Publik</span>
                </a>
            </div>

        </div>
    </div>
</body>
</html>
