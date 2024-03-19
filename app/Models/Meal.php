<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tag;

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
}
