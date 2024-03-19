<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Meal;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];
    protected $table = 'tags';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class);
    }
}
