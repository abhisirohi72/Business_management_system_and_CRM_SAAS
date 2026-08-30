<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::forCompany(Auth::user()->company_id)
            ->with('company', 'project', 'assignedTo')
            ->latest()
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Task::class);

        $projects = Project::forCompany(Auth::user()->company_id)->get();

        $users = Auth::user()->company->users;
        return view('tasks.create', ['projects' => $projects, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $this->authorize('create', Task::class);

        $data = $request->validated();
        // echo Auth::user()->company_id;dd();
        $task = Task::create($data + [
            'company_id' => Auth::user()->company_id,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        
        $task->load('company', 'project', 'assignedTo');
        
        return view("tasks.show", ['task'=> $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $projects = Project::forCompany(Auth::user()->company_id)->get();

        $users = Auth::user()->company->users;

        return view('tasks.edit', ['projects'=>$projects, 'users'=>$users, 'task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update([ 
            'project_id' => $request->project_id,
            'assigned_to' => $request->assigned_to,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tasks Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tasks Deleted Successfully.');
    }
}
