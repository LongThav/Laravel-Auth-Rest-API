<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;

    protected $table = "comments";

    protected $fillable = [
        "body", "user_Id", "post_id", "like_count"
    ];

    // public function getAllComments()
    // {
    //     return $this->hasMany(CommentModel::class, 'post_id');
    // }
}
