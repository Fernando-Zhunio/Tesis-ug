<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'date_start', 'date_end', 'position', 'url_image', 'user_id'];

    protected $casts = [
        'position'=> 'json',
    ];
    protected $appends = ['date_init_convert_diffforhumans','date_end_convert_diffforhumans'];
    public function users(){
        return $this->belongsToMany(User::class, 'user_events', 'user_id', 'event_id');
    }

    public function getDateInitConvertDiffforhumansAttribute(){

        $result = Carbon::parse($this->date_start)->diffForHumans();
        return $result;
    }
    public function getDateEndConvertDiffforhumansAttribute(){

        $result = Carbon::parse($this->date_end)->diffForHumans();
        return $result;
    }
}
