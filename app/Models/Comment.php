<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //RELACIONES
    //Uno a uno inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //
     public function post()
    {
        return $this->belongsTo(Post::class);
    }

    //POLIMORFICA MUCHOS A MUCHOS
    public function likes()
    {
        return $this->morphToMany(Like::class, 'likeable');
    }
}

