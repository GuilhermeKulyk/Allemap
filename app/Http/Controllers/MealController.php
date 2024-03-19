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
        // getting user foods
        $user->foods;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
