<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    // Allows this model to use factories
    use HasFactory;

    // These fields are allowed to be saved
    protected $fillable = [
        'name',
    ];

    /**
     * One category can have many items.
     */
    public function items()
    {
        // Category has many vehicles/items
        return $this->hasMany(Item::class);
    }
}