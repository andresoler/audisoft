<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('sites')->orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Categoría creada.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->sites()->exists()) {
            return redirect()->route('categories.index')
                ->with('error', "No se puede borrar '{$category->name}' porque tiene sitios asignados.");
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoría eliminada.');
    }
}
