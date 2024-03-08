<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Food extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'name'];
    protected $table = 'foods';

    public function foodCategory() {
        return $this->belongsTo('App\Models\FoodCategory', 'category_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'food_ingredients');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getCurrentUserFoods()
    {
        // current user foods
        return Food::where('user_id', Auth::id())->get();
    }

    /**
     * Get the ingredients associated with the food.
     */
    public function foodIngredients()
    {
        return $this->hasMany(FoodIngredient::class);
    }
}