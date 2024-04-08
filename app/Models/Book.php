<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FavoriteBook;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'name', 'description', 'price', 'image', 'cover_image', 'status'
    ];

    public function getStatusAttribute($value)
    {
        return ($value == 1) ? 'Active' : 'In-active';
    }
    
    public function favorite()
    {
        return $this->hasMany(FavoriteBook::class, 'book_id', 'id');
    }
}
