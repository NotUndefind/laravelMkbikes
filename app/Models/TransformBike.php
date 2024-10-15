<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransformBike extends Model {
    use HasFactory;

    protected $fillable = [
        'description',
        'image',
        'alt',
    ];
}
