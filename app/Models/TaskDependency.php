<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskDependency extends Model
{
    //
    public function task ()
    {
        return $this->belongsToMany(Task::class,'task_id', 'dependency_id');
    }
}
