<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'price',
        'created_at',
        'updated_at',
    ];
}