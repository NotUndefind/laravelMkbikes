<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model {
    protected $fillable = ['title', 'content', 'sent_at'];

    public function subscribers() {
        return $this->belongsToMany(Subscriber::class, 'newsletter_subscriber')->withPivot('sent_at')->withTimestamps();
    }
}
