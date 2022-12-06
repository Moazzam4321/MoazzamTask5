<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventorysystem extends Model
{
    use HasFactory;
    protected $table="inventory";
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'category',
    ];

}
