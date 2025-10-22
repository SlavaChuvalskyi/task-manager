<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{

    public function __invoke(): View
    {

        /**  @var User|null $user */
        $user = Auth::user();

        $projectsCount = $user->projects->count();
        $tasks = $user->tasks;
        $tasksCount = $tasks->count();

        // Group tasks by status
        if ($tasksCount > 0) {
            $taskStats = $tasks->toQuery()->select('status', DB::raw('COUNT(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status');
        }

        return view('home', [
            'projectsCount' => $projectsCount,
            'tasksCount' => $tasksCount,
            'taskStats' => $taskStats ?? [],
        ]);

    }

}

