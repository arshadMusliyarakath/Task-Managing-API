<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function tasks(){
        $rules = [
            'user_id' => 'required'
        ];
    
        $customMessages = [
            'user_id.required' => 'The user ID is required. Please provide a valid user ID.'
        ];
    
        $validator = Validator::make(request()->all(), $rules, $customMessages);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ]);
        }
    
        $tasks = Task::where('user_id', request('user_id'))->get();
    
        if ($tasks->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No tasks found for the specified user.',
            ]);
        }
    
        return response()->json([
            'status' => 200,
            'message' => 'All Tasks fetched successfully',
            'tasks' => $tasks,
        ]);
    }
    

    public function addTask(Request $request) {
        $rules = [
            'user_id' => 'required',
            'title' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'image' => 'required|image',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ]);
        }
    
        $data = request()->all();
        $task = Task::create($data);

        if ($request->hasFile('image')) {
            $task->addMediaFromRequest('image')->toMediaCollection('image');
        }
    
        return response()->json([
            'status' => 200,
            'message' => 'Task Created Successfully',
            'data' => $data,
        ]);
    }


    public function updateTask(Request $request) {
        $rules = [
            'task_id' => 'required'
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ]);
        }

        $data = request()->all();
        $task = Task::find(request('task_id'));
        $task->update($data);

        if ($request->hasFile('image')) {
            $task->clearMediaCollection('image');
            $task->addMediaFromRequest('image')->toMediaCollection('image');
        }
    
        return response()->json([
            'status' => 200,
            'message' => 'Task Updated Successfully',
            'data' => $task,
        ]);
    }
    

    public function deleteTask(){
        $rules = [
            'task_id' => 'required|integer',
        ];

        $validator = Validator::make(request()->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ]);
        }

        $task = Task::find(request('task_id'));

        if ($task) {
            $deleted = $task->delete();

            if ($deleted) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Task deleted successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Task deletion failed',
                ]);
            }
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Task not found',
            ]);
        }

    }
       
}
