<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_id',
        'ingredient_id',
    ];

    /**
     * Get the food that owns the food ingredient.
     */
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    /**
     * Get the ingredient that belongs to the food ingredient.
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
/*
    public function getIngredients()
    {
        return FoodIngredient::where('food_id', Auth::id())->get();
    }
    */

}
