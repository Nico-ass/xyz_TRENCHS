<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('app.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('app.categories.show', compact('category'));
    }

    public function create()
    {
        return view('app.categories.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Création de la catégorie
        Category::create($request->only('name'));

        return redirect()->route('app.categories.index')->with('success', 'Catégorie créée avec succès.');
    }
}
