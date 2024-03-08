<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'description', 'user_id'];

    public function ingredient() {
        return $this->belongsTo('App\Models\Ingredient', 'category_id');
    }
}
