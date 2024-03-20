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

use App\Helpers\Notify;
use App\Helpers\Valida;


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

        $foods = Food::where('user_id', Auth::user()->id)
            ->orderBy('name')
            ->get();   

        if (isset($results)) 
        {
            return view('app.food.index',  compact('results', 'foods'));
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
        $user = User::find(Auth::user()->id); // get user

        $userFoodCategories = $user->foodCategories; //get userfoodcategories
        $userIngredients = $user->ingredients()->get();

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
        // create valida objt
        $validator = new Valida($request, 'food-store');
        $result = $validator->errorCheck($request);
          // validation fail
        if (is_array($result)) {
            session(['errors' => $result]);
            return response()->json([
                'formData' => $request->all(), // Retorna os dados do formulário
                'redirect_url' => route('food.create')
            ]); 
        }
        else 
        {
            try {
                // saaving food
                $food->name = $request->input('name');
                $food->category_id = $request->input('category_id');
                $food->user_id = Auth::user()->id;
                $food->save();
                $ingredientIds = json_decode($request->input('foodIngredients'), true);
                
                $this->saveFoodIngredients($request, $food, $ingredientIds);

                return response()->json(['redirect_url' => route('food.index')]);

            } catch (\Illuminate\Database\QueryException $e) {
                // get db errors
                $errors['DB-error'] = ($e->getMessage());
                Log::error('DB|ERROR: ' . $errors['DB-error'] . '|' . Auth::user()->id);
                Notify::error("Something went wrong bro.");
                
                return response();
            }
        }
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
        $user = User::find(Auth::user()->id);
        $userFoodCategories = $user->foodCategories;
        $userIngredients = $user->ingredients()->get();
        $foodIngredients = $food->ingredients()->get();

        return view('app.food.edit', 
        [
            'food'                => $food, 
            'user'                => $user,
            'userFoodCategories'  => $userFoodCategories,
            'userIngredients'     => $userIngredients,
            'foodIngredients'     => $foodIngredients
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food)
    {

        //Log::info($request->input('foodIngredients')->get());
        // validation
        $validator = new Valida($request, 'food-update');
        $result = $validator->errorCheck($request);
        Log::info($request->all());
          // if validation fail
        if (is_array($result)) {
            session(['errors' => $result]);
            return response()->json([
                'formData' => $request->all(), // Retorna os dados do formulário
                'redirect_url' => route('food.create')
            ]); 
        }
        else 
        {
            try {
                // updating food
                $food->where('user_id', Auth::user()->id)
                    ->whereId($food->id)
                    ->update([
                        'name'          => $request->input('name'),
                        'category_id'   => $request->input('category_id')
                ]);

                //remove ingredients -> food_ingredients
                $food->ingredients()->detach();

                // Obter o valor de 'foodIngredients' do request
                $foodIngredientsString = $request->input('foodIngredients');

                // Dividir a string em um array usando a vírgula como delimitador
                $foodIngredients = explode(',', $foodIngredientsString);
 


                // saving 
                $this->saveFoodIngredients($request, $food, $foodIngredients); 

                // disparando a notificação
                $msg = __('messages.food.update.success');
                Notify::success($msg);
                
                return response()->json(['redirect_url' => route('food.index')]);

            } catch (\Illuminate\Database\QueryException $e) 
            {
                $errors['DB-error'] = ($e->getMessage());
                Log::error('UPDATE FOOD DB ERROR: ' . $errors['DB-error']);
                Notify::error("Something went wrong. Try again in a few moments.");

                return response();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $food->delete();
        Notify::success(__('messages.food.destroy.success'));
        return redirect()->route('food.index');
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
            return view('app.meal.index', ['results' => $results]);
        } 
        else
        {
            return view('app.meal.index');
        } 
    }

    private function saveFoodIngredients(Request $request, Food $food, $ingredientIds) 
    {
        Log::info($ingredientIds);
        // check if it has ingredients
        if ($ingredientIds[0] != '' || !empty($array))
        {
            // Iterando sobre os IDs dos ingredientes
            foreach ($ingredientIds as $ingredientId) 
            {
                // Criando uma nova instância de FoodIngredient
                $foodIngredient = new FoodIngredient();

                // Definindo os atributos do FoodIngredient
                $foodIngredient->food_id = $food->id; 
                $foodIngredient->ingredient_id = $ingredientId;

                // Salvando o FoodIngredient no banco de dados
                $foodIngredient->save();
            }
        }
    }
}