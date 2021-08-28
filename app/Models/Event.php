<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'date_start', 'date_end', 'position', 'url_image', 'user_id'];

    protected $casts = [
        'position'=> 'json',
    ];
    public function users(){
        return $this->belongsToMany(User::class, 'user_events', 'user_id', 'event_id');
    }
}
