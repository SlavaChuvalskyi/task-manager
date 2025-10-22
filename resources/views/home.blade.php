@extends('layouts.app')
@section('content')
    <main class="flex flex-col mt-4 p-4">
        <h1 class="my-4 text-2xl font-bold text-gray-800">Dashboard</h1>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
            <div class="bg-blue-100 rounded-xl p-4 shadow">
                <p class="text-sm text-gray-500">Total Projects</p>
                <h2 class="text-3xl font-semibold text-blue-800">{{ $projectsCount }}</h2>
            </div>

            <div class="bg-purple-100 rounded-xl p-4 shadow">
                <p class="text-sm text-gray-500">Total Tasks</p>
                <h2 class="text-3xl font-semibold text-purple-800">{{ $tasksCount }}</h2>
            </div>

            <div class="bg-green-100 rounded-xl p-4 shadow">
                <p class="text-sm text-gray-500">Completed Tasks</p>
                <h2 class="text-3xl font-semibold text-green-800">
                    {{ $taskStats['done'] ?? 0 }}
                </h2>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6 mt-4">
            <h3 class="text-lg font-semibold mb-4">Task Breakdown</h3>
            <ul class="space-y-2">
                <li class="flex justify-between border-b pb-1">
                    <span>To Do</span>
                    <span>{{ $taskStats['new'] ?? 0 }}</span>
                </li>
                <li class="flex justify-between border-b pb-1">
                    <span>In Progress</span>
                    <span>{{ $taskStats['in_progress'] ?? 0 }}</span>
                </li>

                <li class="flex justify-between border-b pb-1">
                    <span>In Review</span>
                    <span>{{ $taskStats['review'] ?? 0 }}</span>
                </li>

                <li class="flex justify-between border-b pb-1">
                    <span>Done</span>
                    <span>{{ $taskStats['completed'] ?? 0 }}</span>
                </li>

                <li class="flex justify-between border-b pb-1">
                    <span>Rejected</span>
                    <span>{{ $taskStats['rejected'] ?? 0 }}</span>
                </li>
            </ul>
        </div>
    </main>
@endsection
