@php
    $current_project_id = request()->route('project')?->id ?? null;
@endphp

@if ($projects && count($projects) > 0)
    <div class="grid">
        @foreach ($projects as $project)
            <a href="{{ route('project.show', $project) }}"
               class="flex items-center gap-3 mb-4 px-3 py-2 rounded-lg transition
                  {{ $current_project_id && $current_project_id === $project->id
                      ? 'bg-blue-50 text-blue-700 font-medium test'
                      : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}"
            >
                 <span class="w-2.5 h-2.5 rounded-full
                    {{ match($loop->index % 4) {
                        0 => 'bg-blue-400',
                        1 => 'bg-purple-400',
                        2 => 'bg-green-400',
                        default => 'bg-orange-400',
                    } }}">
                </span>
                <span>{{ $project->title }}</span>
            </a>
        @endforeach
    </div>
@else
   <p class="flex items-center gap-3 mb-4 px-3 py-2 rounded-lg">You don't have any projects yet</p>
@endif
