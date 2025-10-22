<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function show(Request $request, Project $project)
    {
        $tasks = Task::query()
            ->with('user')
            ->where('project_id', $project->getKey())
            ->orderBy('updated_at', 'desc')
            ->get()
            ->groupBy('status');

        return view('/project/index', ['tasks' => $tasks, 'project' => $project ]);
    }


    public function destroy(Request $request, Project $project)
    {

        $project->delete();
        return redirect('/')->with(['success' => true]);
    }

    public function store(Request $request)
    {

        try {
            /**  @var User|null $user */
            $user = Auth::user();

            $projectData = $request->validate(
                ['title' => 'required|unique:App\Models\Project,title|string|min:5|max:70', 'description' => 'sometimes|nullable|string|min:5|max:100']
            );

            $projectData['user_id'] = $user->getKey();

            Project::create($projectData);

            return redirect()->back()->with('success', 'Project updated successfully.');
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
}
