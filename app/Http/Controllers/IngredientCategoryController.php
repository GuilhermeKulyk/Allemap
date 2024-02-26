<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\IngredientCategory;
use Illuminate\Support\Facades\DB;


class IngredientCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        // get categories
        $results = DB::table('ingredient_categories')
            ->where('user_id', Auth::user()->id)
            ->orderBy('category_name')
            ->get()
            ->toArray(); 
            
            //dd($results);

        if (isset($results)) 
        {
            return view('app.ingredient-category.index',  compact('results'));
        } 
        else 
        {
            return view('app.ingredient-category.index');
        } 
    }

    // lge -  

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
        $category->category_name = $request->get('category_name');
        $category->description = $request->get('description');
        $category->user_id = Auth::user()->id;

        $category->create($category->attributesToArray());

        return view('app.ingredient-category.index');
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

    // Aux functions
    /**
     * Convert the column header name
     */

}
