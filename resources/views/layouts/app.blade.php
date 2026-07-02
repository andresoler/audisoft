<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mis sitios favoritos')</title>
    <meta name="description" content="Gestor de sitios web favoritos — organiza tus enlaces por categorías.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:ital,opsz,wght@0,14..32,300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Space Grotesk"', 'system-ui', 'sans-serif'],
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        pine: {
                            50:  '#f0fdf6',
                            100: '#dcfce9',
                            200: '#bbf7d4',
                            300: '#86efb0',
                            400: '#4ade83',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                            950: '#052e16',
                        },
                    },
                    animation: {
                        'gradient': 'gradient 8s ease infinite',
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-up': 'slideUp 0.4s ease-out',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(12px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                    },
                },
            },
        };
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d4d4d8; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #a1a1aa; }

        /* Animated gradient line */
        .gradient-line {
            background: linear-gradient(90deg, #22c55e, #06b6d4, #8b5cf6, #22c55e);
            background-size: 300% 100%;
            animation: gradient 8s ease infinite;
        }

        /* Nav link active indicator */
        .nav-active {
            position: relative;
        }
        .nav-active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 60%;
            border-radius: 0 4px 4px 0;
            background: linear-gradient(180deg, #22c55e, #06b6d4);
        }

        /* Input focus glow */
        input:focus, select:focus, textarea:focus {
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }

        /* Table row enter animation */
        tbody tr {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</head>
<body class="bg-white font-sans text-gray-800 min-h-screen antialiased">
    {{-- Animated gradient accent line at the very top --}}
    <div class="gradient-line h-[2px] w-full fixed top-0 left-0 z-50"></div>

    <div class="flex min-h-screen">
        {{-- Sidebar Navigation --}}
        <aside class="fixed top-0 left-0 h-full w-64 bg-gray-50/80 backdrop-blur-xl border-r border-gray-200/70 flex flex-col z-40 pt-[2px]">
            {{-- Logo --}}
            <div class="px-6 py-6 border-b border-gray-200/70">
                <a href="{{ route('sites.index') }}" class="flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-pine-500 to-cyan-500 flex items-center justify-center shadow-lg shadow-pine-500/20 group-hover:shadow-pine-500/40 transition-shadow duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <div>
                        <span class="font-display font-bold text-gray-900 text-sm tracking-tight">Audisoft</span>
                        <span class="block text-[11px] text-gray-400 font-medium">Prueba técnica</span>
                    </div>
                </a>
            </div>

            {{-- Navigation Links --}}
            <nav class="flex-1 px-3 py-5 space-y-1">
                <p class="px-3 mb-3 text-[10px] font-semibold uppercase tracking-widest text-gray-400">Navegación</p>

                <a href="{{ route('sites.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('sites.*')
                              ? 'nav-active bg-pine-50 text-pine-700'
                              : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                    <svg class="w-[18px] h-[18px] {{ request()->routeIs('sites.*') ? 'text-pine-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                    </svg>
                    Sitios
                </a>

                <a href="{{ route('categories.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                          {{ request()->routeIs('categories.*')
                              ? 'nav-active bg-pine-50 text-pine-700'
                              : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                    <svg class="w-[18px] h-[18px] {{ request()->routeIs('categories.*') ? 'text-pine-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>
                    Categorías
                </a>
            </nav>

            {{-- Footer --}}
            <div class="px-6 py-4 border-t border-gray-200/70">
                <p class="text-[11px] text-gray-400">Audisoft · Prueba técnica</p>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 ml-64 pt-[2px]">
            {{-- Top header bar --}}
            <header class="sticky top-[2px] z-30 bg-white/80 backdrop-blur-xl border-b border-gray-200/70">
                <div class="max-w-5xl mx-auto px-8 py-4 flex items-center justify-between">
                    <h1 class="font-display text-lg font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                    <div class="flex items-center gap-3">
                        @yield('header-actions')
                    </div>
                </div>
            </header>

            {{-- Flash Messages --}}
            <div class="max-w-5xl mx-auto px-8">
                @if (session('success'))
                    <div class="mt-6 animate-slide-up flex items-center gap-3 rounded-xl bg-pine-50 border border-pine-200 text-pine-700 px-5 py-3.5 text-sm font-medium" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mt-6 animate-slide-up flex items-center gap-3 rounded-xl bg-red-50 border border-red-200 text-red-700 px-5 py-3.5 text-sm font-medium" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            {{-- Page Content --}}
            <div class="max-w-5xl mx-auto px-8 py-8 animate-fade-in">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- SweetAlert2 delete confirmation --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.swal-delete-form').forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const name = this.dataset.name;
                    const type = this.dataset.type;
                    const formEl = this;

                    Swal.fire({
                        title: '¿Eliminar ' + type + '?',
                        html: 'Estás a punto de eliminar <strong>' + name + '</strong>.<br>Esta acción no se puede deshacer.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                        reverseButtons: true,
                        focusCancel: true,
                        customClass: {
                            popup: 'rounded-2xl',
                            confirmButton: 'rounded-xl px-5 py-2.5 text-sm font-semibold',
                            cancelButton: 'rounded-xl px-5 py-2.5 text-sm font-semibold',
                        }
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            formEl.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>