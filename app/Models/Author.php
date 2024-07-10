<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'first_name',
            'last_name',
            'biography',
            'created_at',
            'updated_at',

        ];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

}
