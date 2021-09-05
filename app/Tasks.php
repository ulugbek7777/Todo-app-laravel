<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $guarded = [];

    public function subtasks() {
        return $this->hasMany(subtask::class, 'task_id');
    }
}
