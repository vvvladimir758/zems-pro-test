<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'project_id',
    ];
    
    public function timeSpent(): HasMany
    {
        return $this->hasMany(TimeSpent::class,'task_id','id');
    }
}
