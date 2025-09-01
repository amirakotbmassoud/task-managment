<?php

namespace App\Repository\Task;

use App\Interface\Task\TaskInterface;
use App\Models\Task;

class TaskRepository implements TaskInterface
{
    public function allTasks(array $filters = [])
    {
        $query = Task::query();
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['due_date_from']) && !empty($filters['due_date_to'])) {
            $query->whereBetween('due_date', [$filters['due_date_from'], $filters['due_date_to']]);
        }
        if (!empty($filters['assigned_to'])) {
            $query->where('assigned_to', $filters['assigned_to']);
        }

        return $query->get();
    }
    public function createTAsk(array $data)
    {
        $results = Task::create($data);
        return $results;
    }
    public function updateTask(array $data, $id)
    {
        $tasks = Task::find($id);
        if (!$tasks) {
            throw new \Exception('Task not found');
        }
        $tasks->update($data);
        return $tasks;
    }
    public function assignTask($task_id, $user_id)
    {
        $task = Task::find($task_id);
        if (!$task) {
            throw new \Exception('Task not found');
        }
        $task->assigned_to = (int)$user_id;
        $task->save();
        return $task;
    }
    public function aadddependencies($task_id, array $dependency_ids)
    {
        $task = Task::find($task_id);
        if (!$task) {
            throw new \Exception("Task not found");
        }
        $vaildDependencies = Task::whereIn('id', $dependency_ids)->pluck('id');
        if (count($vaildDependencies) !== count($dependency_ids)) {
            throw new \Exception("one or more dependencies not found");
        }
        $task->dependencies()->syncWithoutDetaching($vaildDependencies);
        return $task->load('dependencies');
    }
    public function getTaskDetails($id)
    {
        $task = Task::with('dependencies')->find($id);
        if (!$task) {
            throw new \Exception('Task not found');
        }
        return $task;
    }
    public function findByTaskId($id)
    {
        return Task::find($id);
    }
    //
}
