<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;

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
        'category_id',
    ];

    /**
     * One item belongs to one category.
     */
    public function categoryRel()
    {
        // We call it categoryRel because we already have a category column
        return $this->belongsTo(Category::class, 'category_id');
    }
}