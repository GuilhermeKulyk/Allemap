<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Food;
use App\Models\FoodCategory;


class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Food::all();
        return view('app.food.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $food = new Food(); // Criar uma nova instância do modelo Food
        $foodCategories = FoodCategory::all();

        return view('app.food.create', 
        [
            'food' => $food, 
            'foodCategories' => $foodCategories
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
            'category_id' => 'required|exists:food_categories,id'
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
       
        // Adiciona o user_id aos dados do foode
        $foodData = $request->all();
        $foodData['user_id'] = Auth::id();
    
        // Cria o foode com os dados fornecidos
        Food::create($foodData);
    
        return redirect()->route('food.index')->with('success', 'Food created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return view('app.food.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {   
        // Localiznado model FoodCategory
        $foodCategory = $food->foodCategory()->find($food->category_id);
        $foodCategories = FoodCategory::all();

        return view('app.food.edit', compact('food', 'foodCategory', 'foodCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food)
    {

        $rules = [
            'name' => 'required|string|min:3|max:255|unique',
            'category_id' => 'required|exists:food_categories,id'
        ];

        $feedback = [
            'required'               => __("messages.validation.feedback.required"),
            'name.unique'            => __("messages.validation.feedback.name.unique"), 
            'max'                    => __("messages.validation.feedback.name.max"),
            'name.min'               => __("messages.validation.feedback.name.min"),
        ];

        $request->validate([$rules, $feedback]);

        try 
        {
            $food->where('user_id', Auth::user()->id)
                ->whereId($food->id)
                ->update([
                    'name'          => $request->input('name'),
                    'category_id'   => $request->input('category_id')
                ]);

        } catch (\Illuminate\Database\QueryException $e) {
            $errors['DB-error'] = ($e->getMessage());
            echo $errors['DB-error'];
        }

        return redirect()->route('food.index')->with('success', 'Food updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('food.index')->with('success', 'Food deleted successfully');
    }

        /**
     * Remove the specified resource from storage
     * @param  \App\Food $Food
     * @param string $search
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, Food $food)
    {   
        $search = $request->get('search');
        $results = $food->where('name', 'LIKE', '%' . $search . '%')->get();
        
        if (isset($results)) 
        {
            return view('app.food.index', ['results' => $results]);
        } 
        else
        {
            return view('app.food.index');
        } 
    }
}