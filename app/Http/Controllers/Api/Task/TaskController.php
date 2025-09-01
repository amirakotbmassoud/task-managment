<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\validateFilter;
use App\Interface\Task\TaskInterface;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ResponseTrait;
    protected $task;
    public function __construct(TaskInterface $task)
    {
$this->task=$task;
    }
    /**
     * Display a listing of the resource.
     */
public function allTasks(validateFilter $request){
     $filters=$request->validated();
        if (auth()->user()->role === 'user') {
            $filters['assigned_to'] = auth()->id();
        }
     $results=$this->task->allTasks($filters);
return self::success('success','Tasks retrived successfully',$results,200);
}
public function creatTask(TaskRequest $task){
    try{
$validated=$task->validated();
$results=$this->task->createTask($validated);
return self::success('success','Task created successfully',$results,201);
}catch(\Exception $e){
    return self::error('error',$e->getMessage(),500);
}
}
public function updateTask(TaskRequest $request,$id){
try{
    $task=$this->task->findByTaskId($id);
$validated=$request->validated();
if(auth()->user()->role==='user'){
    if($validated->assigned_to !==auth()->id()){
        return self::error('error','Unauthorized',403);
    }
    $validated=$request->only(['status']);
}
            $validated = $request->validated();
 if (isset($validated['status']) && $validated['status'] === 'completed') {
            $incompleteDependencies = $task->dependencies()->where('status', '!=', 'completed')->count();

            if ($incompleteDependencies > 0) {
                return self::error('error', 'Cannot complete task. Some dependencies are not completed.', 400);
            }
        }
            $results=$this->task->updateTask($validated,$id);

            return self::success('success','Task updated successfully',$results,200);
}catch(\Exception $e){
    return self::error('error',$e->getMessage(),500);
}
}
public function assignTask($task_id,$user_id){
    try{
$task=$this->task->assignTask($task_id,$user_id);
return self::success('success','Task assigned successfully',$task,200);
}catch(\Exception $e){
        return self::error('error',$e->getMessage(),500);
    }
}
    public function addDependencies(Request $request, $task_id)
    {
        try {
            $validated = $request->validate([
                'dependencies' => 'required|array',
                'dependencies.*' => 'exists:tasks,id',
            ]);

            $dependencies = $validated['dependencies'];

            $task = $this->task->aadddependencies($task_id, $dependencies);

            return self::success('success', 'Dependencies added successfully', $task, 200);
        } catch (\Exception $e) {
            return self::error('error', $e->getMessage(), 500);
        }
    }
    public function getTaskDetails($id)
    {
        try {
            return $this->task->getTaskDetails($id);
        } catch (\Exception $e) {
            return self::error('error', $e->getMessage(), 500);
        }
    }
}

