<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'user_id', 'semester_id', 'career_id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function semester(){
        return $this->belongsTo('App\Models\Semester');
    }

    public function career(){
        return $this->belongsTo('App\Models\Career');
    }
}
