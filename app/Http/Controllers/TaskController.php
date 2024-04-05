<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TimeSpent;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $projects =  Project::where('user_id', Auth::id())
        ->with('image')
        ->with('tasks.timeSpent')
        ->get()
        ->toJson();

        return view('tasks.index')
               ->with('projects',$projects);
    }
    
    public function taskData($id){
        
        //dd($id, Task::whereId($id) ->get()->toJson());
        return Task::whereId($id)
               ->with('timeSpent')
               ->first()
               ->toJson();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $data = [
            'title'       => $request->get('title'),
            'description' => $request->get('description'),
            'user_id'     => Auth::id(),
            'project_id'  => $request->project_id,
        ];

        $task = Task::create($data);
        $data['id'] = $task->id;
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
      
      return view('tasks.task')
      ->with('taskId',$task->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $data = [
            'title'       => $request->get('title'),
            'description' => $request->get('description'),
            'user_id'     => Auth::id()
        ];

        $task->update($data);
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->destroy($task->id);
    }
}
