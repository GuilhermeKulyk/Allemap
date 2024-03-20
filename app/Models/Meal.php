<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'notes', 'when', 'rating'];
    protected $table = 'meals';

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Definindo o relacionamento com os alimentos (foods)
    public function foods()
    {
        return $this->belongsToMany(Food::class, 'meal_foods'); // 'meal_foods' é a tabela intermediária
    }
}
