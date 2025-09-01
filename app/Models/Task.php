<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=['title','description','status','assigned_to','created_by','due_date'];
    public function dependcies(){
        return $this->belongsToMany(Task::class,'task_dependencies','task_id');
    }
    public function assigns()
    {
        return $this->belongsTo(User::class,'assigned_to');
    }
    public function creator()
    {
    return $this->belongsTo(User::class,'created_by');
   }

    //
}
