<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index(): View
    {
        $sites = Site::with('category')->latest()->get();
        $categories = Category::orderBy('name')->get();

        return view('sites.index', compact('sites', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
        ], [
            'url.url' => 'La dirección debe ser una URL válida, por ejemplo https://ejemplo.com',
        ]);

        Site::create($validated);

        return redirect()->route('sites.index')->with('success', 'Sitio agregado correctamente.');
    }

    public function destroy(Site $site): RedirectResponse
    {
        $site->delete();

        return redirect()->route('sites.index')->with('success', 'Sitio eliminado.');
    }
}
