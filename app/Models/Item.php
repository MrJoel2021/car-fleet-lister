<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    // Allows this model to use ItemFactory
    use HasFactory;

    // These fields are allowed to be saved using Item::create()
    protected $fillable = [
        'product',
        'category',
        'quantity',
        'price',
    ];
}