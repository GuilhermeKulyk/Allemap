<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealFood extends Model
{
    use HasFactory;

    protected $fillable = ['meal_id', 'food_id', 'user_id'];
    protected $table = 'meal_foods';

    // Relacionamento com a refeição (meal)
    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    // Relacionamento com o alimento (food)
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    // Relacionamento com o usuário (user) - Se necessário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
