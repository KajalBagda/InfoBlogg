<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    function getAuthor()
    {
        return $this->hasOne(User::class, 'id', 'author');
    }
}
