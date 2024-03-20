<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Models\FoodCategory;
use App\Models\FoodIngredient;
use App\Models\Food;
use App\Models\User;
use App\Models\Meal;
use App\Models\MealTags;
use App\Models\MealFood;

use App\Helpers\Notify;
use App\Helpers\Valida;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meals = DB::table('meals')
            ->where('user_id', Auth::user()->id)
            ->orderBy('when', 'desc')
            ->get()
            ->toArray(); 

        return view('app.meal.index', compact('meals') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::find(Auth::user()->id); // get user

        // creating new instance for meal
        $meal = new Meal();

        return view('app.meal.create', compact('user', 'meal') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // create valida objt
        $validator = new Valida($request, 'meal-store');
        $result = $validator->errorCheck($request);

          // validation fail
        if (is_array($result)) {
            session(['errors' => $result]);
            return redirect()->back()->withErrors($validator);
        }
        else 
        {
            try {
                $meal = new Meal();
                $meal->title = $request->input('title');
                $meal->notes = $request->input('notes');
                $meal->user_id = Auth::user()->id;
                $meal->when = $request->input('when');
                //$meal->rating = $request->input('rating'); _TASK_
                $meal->save();
                
                //  _TASK_ save food tag 
                
                
                // _DONE_ save meal_food   
                $mealFoodIds = json_decode($request->input('mealFoods'), true);
                
                // check if it has food
                if ($mealFoodIds[0] != '' || !empty($array))
                {
                    foreach ($mealFoodIds as $mealFoodId) 
                    {
                        $mealFood          = new MealFood();
                        $mealFood->meal_id = $meal->id; 
                        $mealFood->food_id = $mealFoodId;
                        $mealFood->user_id = Auth::user()->id;

                        // _TASK_ VALIDADE TO BE UNIQUE BY MEAL_ID 
        
                        // Salvando o mealFood no banco
                        $mealFood->save();
                    }
                }

                return response()->json(['redirect_url' => route('meal.index')]);

            } catch (\Illuminate\Database\QueryException $e) {
                // get db errors
                $errors['DB-error'] = ($e->getMessage());
                Log::error('DB -> ERROR: ' . $errors['DB-error'] . '|' . Auth::user()->id);
                Notify::error("Something went wrong.");
                
                return response()->json(['redirect_url' => route('meal.create')]);
            }
        }
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
