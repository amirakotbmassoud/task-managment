<?php

namespace App\Interface\Task;

interface TaskInterface
{
    public function allTasks();
    public function createTask(array $data);
    public function updateTask(array $data,$id);
    public function assignTask($task_id,$user_id);
    public function aadddependencies($task_id, array $dependency_ids);
    public function getTaskDetails($id);
    public function findByTaskId($id);


        //
    }
