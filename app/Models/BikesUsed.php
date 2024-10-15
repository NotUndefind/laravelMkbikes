<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikesUsed extends Model {
    use HasFactory;

    protected $fillable = [
        'description',
        'image',
        'alt',
    ];
}
