<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'name'];
    protected $table = 'foods';

    public function foodCategory() {
        return $this->belongsTo('App\Models\FoodCategory', 'category_id');
    }
}