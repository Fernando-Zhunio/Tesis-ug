<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUg extends Model
{
    use HasFactory;

    public $appends = ['images'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


}

