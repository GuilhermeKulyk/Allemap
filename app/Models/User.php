<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function foodCategories()
    {
        return $this->hasMany(FoodCategory::class);
    }

    // Define a relationship where a user has many meals
    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    // Define a relationship where a user has many tags through meals
    public function tags()
    {
        // The hasManyThrough method defines a relationship with a distant relation via an intermediate relation
        // In this case, it allows the user to access tags associated with their meals indirectly
        return $this->hasManyThrough(Tag::class, Meal::class);

        // NOTE: $user->tags 
    }
}