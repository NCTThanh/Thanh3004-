<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'McLaren Vietnam') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,600,800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root { --mc-orange: #FF7E00; --mc-dark: #121212; }
            body { font-family: 'Inter', sans-serif; background-color: #000; color: white; }
            
            .auth-bg {
                background-image: url('https://cars.mclaren.press/content/dam/press/mclaren-automotive/models/750s/750s-spider/750S_Spider_01.jpg'); 
                background-size: cover; background-position: center; position: relative;
            }
            .auth-overlay { background: rgba(0,0,0,0.75); position: absolute; inset: 0; backdrop-filter: blur(5px); }
            .auth-card {
                background: rgba(20, 20, 20, 0.9); border: 1px solid #333;
                box-shadow: 0 10px 40px rgba(0,0,0,0.8); backdrop-filter: blur(10px);
            }
            .btn-social { transition: 0.3s; border: 1px solid #333; color: #ccc; }
            .btn-social:hover { border-color: var(--mc-orange); color: white; background: rgba(255, 126, 0, 0.1); }
            .form-input { 
                background: #0a0a0a; border: 1px solid #333; color: white; 
            }
            .form-input:focus { border-color: var(--mc-orange); ring: 0; outline: none; box-shadow: 0 0 0 2px rgba(255,126,0,0.3); }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-100">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 auth-bg">
            <div class="auth-overlay"></div>
            
            <div class="relative z-10 flex flex-col items-center">
                <a href="/" class="mb-6">
                    <h1 class="text-4xl font-black tracking-widest text-white uppercase" style="font-family: 'Arial Black', sans-serif;">McLaren</h1>
                </a>
            
                <div class="w-full sm:max-w-md mt-6 px-8 py-10 auth-card shadow-2xl overflow-hidden sm:rounded-none">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>