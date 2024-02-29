<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Ingredient;
use App\Models\IngredientCategory;


class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Ingredient::all();
        return view('app.ingredient.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $ingredient = new Ingredient(); // Criar uma nova instância do modelo Ingredient
        $ingredientCategories = IngredientCategory::all();

        return view('app.ingredient.create', 
        [
            'ingredient' => $ingredient, 
            'ingredientCategories' => $ingredientCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'toxicity' => 'required|integer',
            'category_id' => 'required|exists:ingredient_categories,id'
        ]);
       
        // Adiciona o user_id aos dados do ingrediente
        $ingredientData = $request->all();
        $ingredientData['user_id'] = Auth::id();
    
        // Cria o ingrediente com os dados fornecidos
        Ingredient::create($ingredientData);
    
        return redirect()->route('ingredient.index')->with('success', 'Ingredient created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        return view('app.ingredient.show', compact('ingredient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        $ingredientCategories = IngredientCategory::all();
        return view('app.ingredient.edit', compact('ingredient', 'ingredientCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'toxicity' => 'required|integer',
            'category_id' => 'required|exists:ingredient_categories,id'
        ]);

        $ingredient->update($request->all());
        return redirect()->route('ingredient.index')->with('success', 'Ingredient updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect()->route('ingredient.index')->with('success', 'Ingredient deleted successfully');
    }
}