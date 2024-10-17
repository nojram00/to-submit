<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const CATEGORIES = ['Consumable', 'Non-Consumable'];

    protected $fillable = [
        'name',
        'category',
        'description',
        'datetime'
    ];
}
