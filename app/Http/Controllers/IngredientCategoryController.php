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
        $rules = [
            'category_name' => 'required|min:3|max:25',
            'description' => 'max:2000',
        ];

        $feedback = [
            'required'          => __("messages.validation.feedback.required"),
            'unique'            => __("messages.validation.feedback.category_name.unique"), 
            'category_name.min' => __("messages.validation.feedback.category_name.min"),
            'category_name.max' => __("messages.validation.feedback.category_name.max"),
            'description.max'   => __("messages.validation.feedback.description.max")
        ];
       
        $request->validate($rules, $feedback);

        $category = new IngredientCategory();
        $category->category_name = $request->get('category_name');
        $category->description = $request->get('description');
        $category->user_id = Auth::user()->id;

        $category->create($category->attributesToArray());

        return redirect()->route('ingredient-category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IngredientCategory $ingredientCategory)
    {
        $ingredientCategory = IngredientCategory::find($ingredientCategory->id);

        // check if this category was created by the user, otherwise redirects to the previous page
        if ($ingredientCategory->user_id == Auth::user()->id) 
        {
            return view('app.ingredient-category.edit', ['ingredientCategory' => $ingredientCategory]);
        }
        else
        {
            redirect(url()->previous());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IngredientCategory $ingredientCategory, int $id)
    {
        $rules = [
            'category_name' => 'required|min:3|max:25',
            'description' => 'max:2000'
        ];

        $feedback = [
            'required'          => __("messages.validation.feedback.required"),
            /*'unique'          => __("messages.validation.feedback.category_name.unique"), */
            'category_name.min' => __("messages.validation.feedback.category_name.min"),
            'category_name.max' => __("messages.validation.feedback.category_name.max"),
            'description.max'   => __("messages.validation.feedback.description.max")
        ];
       
        $request->validate($rules, $feedback);

        $ingredientCategory->category_name = $request->get('category_name');
        $ingredientCategory->description = $request->get('description');
        $ingredientCategory->user_id = Auth::user()->id;

        // pegando da url - gambiarra nervoza =) - deixa baixo bora passar via url no update?
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
            $errors['DB-error'] = ($e->getMessage());
        }

        return redirect()->route('ingredient-category.index');
    }

    /**
     * Remove the specified resource from storage
     * @param  \App\IngredientCategory $IngredientCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(IngredientCategory $ingredientCategory)
    {
        $ingredientCategory->delete();
        return redirect()->route('ingredient-category.index');
    }

    /**
     * Remove the specified resource from storage
     * @param  \App\IngredientCategory $IngredientCategory
     * @param string $search
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, IngredientCategory $ingredientCategory)
    {   
        $search = $request->get('search');
        $results = $ingredientCategory->where('category_name', 'LIKE', '%' . $search . '%')->get();
        
        if (isset($results)) 
        {
            return view('app.ingredient-category.index',  compact('results'));
        } 
        else
        {
            return view('app.ingredient-category.index');
        } 
    }
}
