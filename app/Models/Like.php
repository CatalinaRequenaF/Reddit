<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    //Muchos a muchos inversa
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    //POLIMORFICA MUCHOS A MUCHOS INVERSA
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'likeable');
    }

    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'likeable');
    }
}
