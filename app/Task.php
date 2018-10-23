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

        return $model;
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
