@extends('layouts.app')

@section('title', 'Mis sitios favoritos')
@section('page-title', 'Sitios Web')

@section('header-actions')
    <span class="text-sm text-gray-400">{{ $sites->count() }} {{ $sites->count() === 1 ? 'sitio' : 'sitios' }} guardados</span>
@endsection

@section('content')
    {{-- Add New Site Card --}}
    <div class="mb-8" x-data="{ open: false }">
        <button @click="open = !open"
                class="w-full group flex items-center justify-between px-6 py-4 rounded-2xl border border-dashed border-gray-300 hover:border-pine-400 bg-gray-50/50 hover:bg-pine-50/50 transition-all duration-300">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-pine-50 flex items-center justify-center group-hover:bg-pine-100 transition-colors">
                    <svg class="w-4 h-4 text-pine-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-500 group-hover:text-gray-700 transition-colors">Agregar nuevo sitio</span>
            </div>
            <svg class="w-4 h-4 text-gray-400 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </button>

        <div x-show="open" x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="mt-3">
            <form action="{{ route('sites.store') }}" method="POST"
                  class="rounded-2xl bg-white border border-gray-200 p-6 shadow-xl shadow-gray-200/50">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
                    <div>
                        <label for="site-name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Nombre</label>
                        <input type="text" name="name" id="site-name" placeholder="Mi sitio favorito" required value="{{ old('name') }}"
                               class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-pine-500 focus:ring-1 focus:ring-pine-500/20 transition-all duration-200">
                    </div>
                    <div>
                        <label for="site-url" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Dirección URL</label>
                        <input type="url" name="url" id="site-url" placeholder="https://ejemplo.com" required value="{{ old('url') }}"
                               class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-pine-500 focus:ring-1 focus:ring-pine-500/20 transition-all duration-200">
                    </div>
                    <div>
                        <label for="site-category" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Categoría</label>
                        <select name="category_id" id="site-category" required
                                class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-sm text-gray-800 focus:outline-none focus:border-pine-500 focus:ring-1 focus:ring-pine-500/20 transition-all duration-200 appearance-none cursor-pointer">
                            <option value="">Seleccione una categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3">
                    <button type="button" @click="open = false" class="px-4 py-2 text-sm font-medium text-gray-400 hover:text-gray-600 transition-colors">Cancelar</button>
                    <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-pine-600 to-pine-500 hover:from-pine-500 hover:to-pine-400 text-white text-sm font-semibold shadow-lg shadow-pine-500/20 hover:shadow-pine-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Agregar sitio
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-6 animate-slide-up rounded-xl bg-red-50 border border-red-200 px-5 py-4">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
                <p class="text-sm font-semibold text-red-600">Por favor corrige los siguientes errores:</p>
            </div>
            <ul class="ml-6 space-y-1">
                @foreach ($errors->all() as $error)
                    <li class="text-sm text-red-500">• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Sites Table --}}
    @if ($sites->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-5 animate-pulse-slow">
                <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                </svg>
            </div>
            <h3 class="text-lg font-display font-bold text-gray-700 mb-2">No hay sitios guardados</h3>
            <p class="text-sm text-gray-400 max-w-sm">Agrega tu primer sitio favorito usando el botón de arriba para empezar a organizar tus enlaces.</p>
        </div>
    @else
        <div class="rounded-2xl border border-gray-200 overflow-hidden shadow-xl shadow-gray-200/50 bg-white">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50/80">
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-400">Nombre</th>
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-400">Dirección</th>
                        <th class="px-6 py-4 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-400">Categoría</th>
                        <th class="px-6 py-4 text-right text-[11px] font-semibold uppercase tracking-wider text-gray-400">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($sites as $site)
                        <tr class="group hover:bg-pine-50/40 transition-colors duration-200">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-pine-100 to-cyan-100 flex items-center justify-center flex-shrink-0 group-hover:from-pine-200 group-hover:to-cyan-200 transition-all duration-300">
                                        <span class="text-xs font-bold text-pine-700 uppercase">{{ mb_substr($site->name, 0, 1) }}</span>
                                    </div>
                                    <span class="font-medium text-gray-800">{{ $site->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ $site->url }}" target="_blank" rel="noopener"
                                   class="inline-flex items-center gap-1.5 text-pine-600 hover:text-pine-700 transition-colors group/link">
                                    <span class="truncate max-w-[280px]">{{ $site->url }}</span>
                                    <svg class="w-3.5 h-3.5 opacity-0 group-hover/link:opacity-100 transition-opacity -translate-x-1 group-hover/link:translate-x-0 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-medium bg-pine-50 text-pine-700 border border-pine-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-pine-500"></span>
                                    {{ $site->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('sites.destroy', $site) }}" method="POST"
                                      id="delete-site-{{ $site->id }}"
                                      class="swal-delete-form"
                                      data-name="{{ $site->name }}"
                                      data-type="sitio">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-400 hover:text-red-600 hover:bg-red-50 border border-transparent hover:border-red-200 transition-all duration-200">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        Borrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection