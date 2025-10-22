<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController
{
    public function __construct()
    {
        /**  @var User|null $user */
        $user = Auth::user();

        // For test purpose login first user
        if (!$user) {
            $currentUser = User::first();
            Auth::login($currentUser);
            $user = Auth::user();
        }

        $projects =  Project::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();

        $users = User::query()->select(['id', 'name'])->whereNotNull('email_verified_at')->pluck('name', 'id')->toArray();

        view()->share(['user' => $user, 'projects' => $projects, 'users' => $users]);
    }
}
