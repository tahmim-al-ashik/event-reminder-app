<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'title',
        'description',
        'event_time',
        'email',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
