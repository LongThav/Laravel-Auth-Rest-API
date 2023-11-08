<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAppModel extends Model
{
    use HasFactory;
    protected $table = "userapp";

    protected $fillable = [
        "username", "email"
    ];
}
