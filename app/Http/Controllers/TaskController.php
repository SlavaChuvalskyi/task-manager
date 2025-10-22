<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{

    public function show(Request $request, Project $project, Task $task)
    {
        // Render a Blade partial
        $html = view('task.edit', compact(['project','task']))->render();

        return response()->json([
            'html' => $html
        ]);
    }

    public function store(Request $request, Project $project)
    {

        try {
            $taskData = $request->validate([
                'title' => 'required|string|min:5|max:100',
                'description' => 'required|string|min:10|max:255',
                'assign_user_id' => ['sometimes', 'nullable', 'exists:App\Models\User,id']
            ]);

            $taskData['project_id'] = $project->getKey();
            $taskData['status'] = TaskStatus::NEW;

            Task::create($taskData);

            return redirect()->back()->with('success', 'Task saved successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error occurred.',
            ], 500);
        }

    }

    public function update(Request $request, Project $project, Task $task)
    {
        try {
            $taskData = $request->validate([
                'title' => 'required|string|min:5|max:100',
                'description' => 'required|string|min:10|max:255',
                'status' => ['required', Rule::enum(TaskStatus::class)],
                'assign_user_id' => ['sometimes', 'nullable', 'exists:App\Models\User,id']
            ]);

            $task->update($taskData);

            return redirect()->back()->with('success', 'Task updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error occurred.',
            ], 500);
        }

    }

    public function updateStatus(Request $request, Project $project, Task $task)
    {

        try {
            $taskData = $request->validate(['status' => ['required', Rule::enum(TaskStatus::class)]]);
            $task->update($taskData);

            return redirect()->back()->with('success', 'Task updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error occurred.',
            ], 500);
        }
    }

    public function destroy(Request $request,string $projectID, Task $task)
    {
        $task->delete();
        return redirect()->back()->with('success', 'Task deleted successfully.');
    }

}
