<?php

namespace App\MyDB;

use Illuminate\Database\Eloquent\Model;

class StockModel extends Model
{
    protected $table = 'stock';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        "stock_list",
    ];
}
