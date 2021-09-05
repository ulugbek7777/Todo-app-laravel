<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subtask extends Model
{
    protected $guarded = [];

    public function task() {
        return $this->belongsTo(Tasks::class);
    }
}
