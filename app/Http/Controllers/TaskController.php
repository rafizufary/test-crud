<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Task; 
use App\Models\Status; 

class TaskController extends Controller
{
    public function index()
    {
        // $tasks = Task::all();
        $tasks = Task::with('status')
            ->where('user_id', auth()->id())
            ->get();

        return view('home', compact('tasks'));
    }

    public function input()
    {
        return view('task');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status_id' => 'required|integer|exists:statuses,id',
        ]);

        $validated['user_id'] = auth()->id();
        $task = Task::create($validated);
        return redirect()->route('home')->with('success', 'Form record has been saved successfully!');
    }   

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'status_id' => 'required|integer|exists:statuses,id',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status_id' => $request->status_id,
        ]);

        return redirect()->route('home')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $task->delete();
        return redirect()->route('home')->with('success', 'Task deleted successfully!');
    }
}