@extends('layouts.app')

@section('title', 'Mis categorías')
@section('page-title', 'Categorías')

@section('header-actions')
    <a href="{{ route('sites.index') }}"
       class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-gray-700 transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Regresar a sitios
    </a>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Add Category Card --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24">
                <form action="{{ route('categories.store') }}" method="POST"
                      class="rounded-2xl bg-white border border-gray-200 p-6 shadow-xl shadow-gray-200/50">
                    @csrf
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-lg bg-pine-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-pine-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <h2 class="text-sm font-display font-bold text-gray-800">Nueva categoría</h2>
                    </div>
                    <div class="mb-4">
                        <label for="cat-name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Nombre</label>
                        <input type="text" name="name" id="cat-name" placeholder="Ej: Tecnología" required value="{{ old('name') }}"
                               class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-pine-500 focus:ring-1 focus:ring-pine-500/20 transition-all duration-200">
                    </div>
                    <button type="submit"
                            class="w-full px-5 py-2.5 rounded-xl bg-gradient-to-r from-pine-600 to-pine-500 hover:from-pine-500 hover:to-pine-400 text-white text-sm font-semibold shadow-lg shadow-pine-500/20 hover:shadow-pine-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Crear categoría
                        </span>
                    </button>
                </form>

                @if ($errors->any())
                    <div class="mt-4 animate-slide-up rounded-xl bg-red-50 border border-red-200 px-5 py-4">
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm text-red-500 flex items-center gap-2">
                                    <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        {{-- Categories Grid --}}
        <div class="lg:col-span-2">
            @if ($categories->isEmpty())
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-5 animate-pulse-slow">
                        <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-display font-bold text-gray-700 mb-2">Sin categorías aún</h3>
                    <p class="text-sm text-gray-400 max-w-sm">Crea tu primera categoría usando el formulario de la izquierda para empezar a organizar tus sitios.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($categories as $category)
                        <div class="group rounded-2xl bg-white border border-gray-200 hover:border-gray-300 p-5 transition-all duration-300 hover:shadow-lg hover:shadow-gray-200/50 hover:-translate-y-0.5">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-pine-100 to-cyan-100 flex items-center justify-center group-hover:from-pine-200 group-hover:to-cyan-200 transition-all duration-300">
                                        <svg class="w-5 h-5 text-pine-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 text-sm">{{ $category->name }}</h3>
                                        <p class="text-xs text-gray-400 mt-0.5">
                                            {{ $category->sites_count }} {{ $category->sites_count === 1 ? 'sitio' : 'sitios' }}
                                        </p>
                                    </div>
                                </div>

                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                      id="delete-category-{{ $category->id }}"
                                      class="swal-delete-form"
                                      data-name="{{ $category->name }}"
                                      data-type="categoría">
                                    @csrf
                                    @method('DELETE')
                                    @if ($category->sites_count > 0)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-medium bg-amber-50 text-amber-600 border border-amber-200 cursor-not-allowed"
                                              title="No se puede borrar: tiene sitios asignados">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                            </svg>
                                            En uso
                                        </span>
                                    @else
                                        <button type="submit"
                                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-medium text-gray-400 hover:text-red-600 hover:bg-red-50 border border-transparent hover:border-red-200 transition-all duration-200 opacity-0 group-hover:opacity-100">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            Borrar
                                        </button>
                                    @endif
                                </form>
                            </div>

                            {{-- Visual bar indicator --}}
                            <div class="mt-4 h-1 rounded-full bg-gray-100 overflow-hidden">
                                @if ($category->sites_count > 0)
                                    <div class="h-full rounded-full bg-gradient-to-r from-pine-500 to-cyan-500"
                                         style="width: {{ min($category->sites_count * 20, 100) }}%"></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection