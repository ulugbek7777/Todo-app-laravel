<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'chapters';
    protected $guarded = [];

    public function task() {
        return $this->hasMany(Tasks::class, 'chapter_id');
    }
}
