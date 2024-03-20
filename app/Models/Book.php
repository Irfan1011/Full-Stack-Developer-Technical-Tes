<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Initial tabel in database
    protected $table = 'book';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // fillable form input
    protected $fillable = [
        'title',
        'author',
        'description',
    ];
}
