<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TimeSpent extends Model
{
    use HasFactory;
    
    protected $table = 'tasks_time_spent';
    
    protected $fillable = [
        'description',
        'task_id',
        'time_spent',
        'type',
        'start',
        'stop'
    ];
    
    public function getTimeSpentAttribute($value){
        if($this->type == 'mark'){
            $start = Carbon::parse($this->start);
            if($this->stop == NULL){
                return $start->diff(Carbon::now())->format('%h:%i:%s');
            }
        }
        return $value;
    }

}
