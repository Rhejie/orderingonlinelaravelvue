<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $cast = ['order' => 'array'];
    protected $fillable = ['order', 'tax', 'price', 'coupon'];
}
