<?php

namespace App\MyDB;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        "account",
        "password",
        "email",
        "updated_at",
        "created_at",
    ];
}
