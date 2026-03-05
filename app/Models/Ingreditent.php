<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreditent extends Model
{
    /** @use HasFactory<\Database\Factories\IngreditentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'meal_ingedient');
    }
}
