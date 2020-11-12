<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $guarded = [];
    protected $table = 'feedbacks';

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat("Y-m-d H:i:s", $date)->format("d/m/Y H:i:s");
    }
}
