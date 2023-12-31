<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $with = ['user:id,name,image', 'comments.user:id,name,image'];

    // or the below code will work but will only select all from database.

    // protected $with = ['user', 'comments.user'];

    protected $fillable = ['content', 'user_id'];


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public  function likes()
    {
        return $this->belongsToMany(user::class, 'idea_like')->withTimestamps();
    }
}
