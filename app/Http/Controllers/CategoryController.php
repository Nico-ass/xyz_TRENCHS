<?php

namespace App\Http\Controllers;

use App\Models\Category; // Assurez-vous d'importer le modèle Category
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Récupérer toutes les catégories
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function create()
    {
        return view('categories.create'); // Vue pour créer une catégorie
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Création de la catégorie
        Category::create($request->only('name'));

        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès.');
    }
}
