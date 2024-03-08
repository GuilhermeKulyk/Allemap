<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\IngredientCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\User;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $results = $user->ingredients;

        if (isset($results)) 
        {
            return view('app.ingredient.index',  compact('results'));
        } 
        else 
        {
            return view('app.ingredient.index');
        } 
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
        $rules = [
            'name' => 'required|string|min:3|max:255|unique',
            'toxicity' => 'min:0|max:4|required|integer|between:min,max',
            'category_id' => 'required|exists:ingredient_categories,id'
        ];

        $feedback = [
            'required'               => __("messages.validation.feedback.required"),
            'name.unique'            => __("messages.validation.feedback.name.unique"), 
            'max'                    => __("messages.validation.feedback.name.max"),
            'name.min'               => __("messages.validation.feedback.name.min"),
            'toxicity.min'           => __("messages.validation.feedback.toxicity.min"),
            'toxicity.max'           => __("messages.validation.feedback.toxicity.max"),   
            'toxicity.required'      => __("messages.validation.feedback.toxicity.required"),
            'toxicity.between'       => __("messages.validation.feedback.toxicity.invalid-number"), 
            'toxicity.min'           => __("messages.validation.feedback.name.required")
        ];

        $request->validate([$rules, $feedback]);
       
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
        // Localiznado model IngredientCategory
        $ingredientCategory = $ingredient->ingredientCategory()->find($ingredient->category_id);
        $ingredientCategories = IngredientCategory::all();

        return view('app.ingredient.edit', compact('ingredient', 'ingredientCategory', 'ingredientCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {

        $rules = [
            'name' => 'required|string|min:3|max:255|unique',
            'toxicity' => 'min:0|max:4|required|integer|between:min,max',
            'category_id' => 'required|exists:ingredient_categories,id'
        ];

        $feedback = [
            'required'               => __("messages.validation.feedback.required"),
            'name.unique'            => __("messages.validation.feedback.name.unique"), 
            'max'                    => __("messages.validation.feedback.name.max"),
            'name.min'               => __("messages.validation.feedback.name.min"),
            'toxicity.min'           => __("messages.validation.feedback.toxicity.min"),
            'toxicity.max'           => __("messages.validation.feedback.toxicity.max"),   
            'toxicity.required'      => __("messages.validation.feedback.toxicity.required"),
            'toxicity.between'       => __("messages.validation.feedback.toxicity.invalid-number"), 
            'toxicity.min'           => __("messages.validation.feedback.name.required")
        ];

        $request->validate([$rules, $feedback]);

        try {
            $ingredient->where('user_id', Auth::user()->id)
            ->whereId($ingredient->id)
            ->update([
                'name'          => $request->input('name'),
                'toxicity'      => $request->input('toxicity'),
                'category_id'   => $request->input('category_id')
            ]);

        } catch (\Illuminate\Database\QueryException $e) {
            $errors['DB-error'] = ($e->getMessage());
            echo $errors['DB-error'];
        }

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

        /**
     * Remove the specified resource from storage
     * @param  \App\Ingredient $Ingredient
     * @param string $search
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, Ingredient $ingredient)
    {   
        $search = $request->get('search');
        $results = $ingredient->where('name', 'LIKE', '%' . $search . '%')->get();
        
        if (isset($results)) 
        {
            return view('app.ingredient.index',  compact('results'));
        } 
        else
        {
            return view('app.ingredient.index');
        } 
    }
}