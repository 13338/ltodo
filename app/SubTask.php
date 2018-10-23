<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    
    /**
     * Get the task that owns the subtask.
     */
    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
