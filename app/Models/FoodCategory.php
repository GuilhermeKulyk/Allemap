<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_name',
        'id'
    ];

    /**
     * Get the user that owns the food category.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the foods for the category.
     */
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
