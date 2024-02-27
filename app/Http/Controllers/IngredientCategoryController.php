<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\IngredientCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

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

        return redirect('app.ingredient-category.index');
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
     * Show the form for editing the specified resource.
     */
    public function edit(IngredientCategory $ingredientCategory)
    {
        $ingredientCategory = IngredientCategory::find($ingredientCategory->id);

        return view('app.ingredient-category.edit', ['ingredientCategory' => $ingredientCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IngredientCategory $ingredientCategory, int $id)
    {
        $rules = [
            'category_name' => 'required|min:3|max:25',
            'description' => 'min:3|max:2000',
        ];

        $feedback = [
            'required' => __("messages.validation.feedback.required"),
            /*'unique' => __("messages.validation.feedback.category_name.unique"), */
            'category_name.min' => __("messages.validation.feedback.category_name.min"),
            'category_name.max' => __("messages.validation.feedback.category_name.max"),
            'description.min' => __("messages.validation.feedback.description.min"),
            'description.max' => __("messages.validation.feedback.description.max")
        ];
       
        $request->validate($rules, $feedback);

        $ingredientCategory->category_name = $request->get('category_name');
        $ingredientCategory->description = $request->get('description');
        $ingredientCategory->user_id = Auth::user()->id;

        // pegando da url - gambiarra nervoza =) - deixa baixo
        //= str_replace("/edit","", (str_replace('http://127.0.0.1:8000/ingredient-category/', "", url()->previous())));

        try 
        {
            $ingredientCategory->where('user_id', Auth::user()->id)
            ->whereId($id)
            ->update([
                'category_name' => $ingredientCategory->category_name,
                'description'   => $ingredientCategory->description
            ]);
        }

        catch (\Illuminate\Database\QueryException $e) 
        {
            dd($e->getMessage());
        }

        return redirect()->route('ingredient-category.index');
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
