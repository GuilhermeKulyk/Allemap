<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\FoodCategory;
use App\Models\FoodIngredient;
use App\Models\Food;
use App\Models\User;



class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = DB::table('foods')
            ->where('user_id', Auth::user()->id)
            ->orderBy('name')
            ->get()
            ->toArray(); 

        if (isset($results)) 
        {
            return view('app.food.index',  compact('results'));
        } 
        else 
        {
            return view('app.food.index');
        } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $food = new Food(); // Criar uma nova instância do modelo Food
        
        $user = User::find(Auth::user()->id);

        $userFoodCategories = $user->foodCategories;
        $userIngredients = $user->ingredients()->get();

        //dd($user->ingredients()->get);
        return view('app.food.create', 
        [
            'food'                => $food, 
            'user'                => $user,
            'userFoodCategories'  => $userFoodCategories,
            'userIngredients'     => $userIngredients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Food $food)
    {       
        $rules = [
            'name' => 'required|string|min:3|max:255|unique',
            'category_id' => 'required|exists:food_categories,id'
        ];

        $feedback = [
            'required'               => __("messages.validation.feedback.required"),
            'unique'            => __("messages.validation.feedback.name.unique"), 
            'max'                    => __("messages.validation.feedback.name.max"),
            'min'               => __("messages.validation.feedback.name.min"),
        ];
        
        //$request->validate($rules, $feedback);
      
        $food->name = $request->input('name');
        $food->category_id = $request->input('category_id');
        $food->user_id = Auth::user()->id;
        $food->save();
        
        // Decodificando os IDs dos ingredientes do JSON para um array PHP
        $ingredientIds = json_decode($request->input('foodIngredients'), true);

        // Iterando sobre os IDs dos ingredientes
        foreach ($ingredientIds as $ingredientId) {
            // Criando uma nova instância de FoodIngredient
            $foodIngredient = new FoodIngredient();

            // Definindo os atributos do FoodIngredient
            $foodIngredient->food_id = $food->id; 
            $foodIngredient->ingredient_id = $ingredientId;

            // Salvando o FoodIngredient no banco de dados
            $foodIngredient->save();
        }

        toastr()->success('Data has been saved successfully!', 'Congrats');
        
        Log::info('Food STORE: ' . $food);
        Log::info('User: ' . Auth::user()->id);      
        
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

        //$request->validate([$rules, $feedback]);

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