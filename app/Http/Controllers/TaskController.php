<?php

namespace App\Http\Controllers;

use App\Models\Task;


class TaskController extends Controller
{
    public function addTask(){
        $data = request()->except('_token');
        $task = Task::create($data);
        if(request()->hasFile('image')){
            $task->addMediaFromRequest('image')->toMediaCollection('image');
            return redirect()->route('home');
        }
        
    }
    public function updateTask()
    {
        $taskId = request('task_id');
        $data = request()->except('_token');
        $task = Task::find($taskId);

        if (request()->hasFile('image')) {
            $task->clearMediaCollection('image');
            $task->addMediaFromRequest('image')->toMediaCollection('image');
        } 
        $task->update($data);
        return redirect()->route('home');
    }

    public function deleteTask($task_id)
    {
        $taskId =  decrypt($task_id);
        $task = Task::find($taskId);
        $task->delete();
        return redirect()->route('home');
    }


}
