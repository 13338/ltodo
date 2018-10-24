<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'done'
    ];

    static public function create($attributes)
    {
        $model = new static($attributes);

        $model->user_id = Auth::id();

        $model->save();

        $model->slug = $model->id . '-' . str_slug($model->title);

        $model->save();
        
        return $model;
    }

    public function delete()
    {
        foreach($this->subTasks as $subTask)
        {
            $subTask->delete();
        }
        
        return parent::delete();
    }

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the subtasks for the task.
     */
    public function subTasks()
    {
        return $this->hasMany('App\SubTask');
    }
}
