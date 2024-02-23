<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IngredientCategory;
use App\Models\Ingredient;

class IngredientCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.ingredient-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.ingredient-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new IngredientCategory();
        $category->create($request->all());

        return view('ingredient-category.store');
    }

    /**
     * Display the specified resource.
     */
    public function list()
    {
        $categories = new IngredientCategory();
        //$categories->where('')
        //dd($list);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
