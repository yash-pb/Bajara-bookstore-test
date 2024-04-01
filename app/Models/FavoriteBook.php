<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteBook extends Model
{
    use HasFactory;
    protected $table = 'favourite_books';
    protected $fillable = [
        'book_id', 'user_id'
    ];
}
