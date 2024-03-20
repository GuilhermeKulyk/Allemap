<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTags extends Model
{
    use HasFactory;

    protected $fillable = ['meal_id', 'tag_id', 'user_id'];

    // Define the table associated with the model
    protected $table = 'meal_tags';

    // Define a relationship where a meal tag belongs to a meal
    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    // Define a relationship where a meal tag belongs to a tag
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
        
    // Definindo o relacionamento com os alimentos (foods)
    public function foods()
    {
        return $this->belongsToMany(Food::class, 'meal_foods'); // 'meal_foods' é a tabela intermediária
    }
}
