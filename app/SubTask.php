<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_id', 'title', 'done'
    ];

    /**
     * Get the task that owns the subtask.
     */
    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
