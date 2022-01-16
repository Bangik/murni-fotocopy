<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Product;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'path_image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
