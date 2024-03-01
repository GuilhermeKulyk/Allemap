<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'name', 'toxicity'];

    public function ingredientCategory() {
        return $this->belongsTo('App\Models\IngredientCategory', 'category_id');
    }
}
