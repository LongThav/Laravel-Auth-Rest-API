<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;

    protected $table = "posts";
    protected $fillable = [
        'image',
        'description',
        'user_Id',
        'like_count'
    ];


    public function getUser(){
        return $this->belongsTo(User::class, 'user_Id');
    }

    public function getAllComments(){
        return $this->hasMany(CommentModel::class, 'post_id');
    }

    public function getAllLike(){
        return $this->hasMany(LikeModel::class, 'post_id');
    }
}
