@props(['task'])

<div
    id="task_{{ $task->id }}"
    class="flex flex-col relative gap-2 bg-green-100 rounded-xl p-2 mx-1 my-2 cursor-grab hover:shadow [&.is-dragging]:cursor-grabbing transition-all duration-150"
    data-id="{{ $task->id }}"
    data-status="{{ $task->status }}"
    draggable="true"
>
    <p class="text-lg min-h-[40px] font-semibold p-2 whitespace-normal">{{ $task->title }}</p>
    <p class="text-sm p-2 max-h-[150px] max-w-[250px] overflow-hidden text-ellipsis whitespace-nowrap">
        {{ $task->description }}
    </p>

    <div class="absolute h-full w-full z-[-5] [&:has(>_.loading:not(.hidden))]:backdrop-blur-sm:!z-50">
        <x-spinner className="mt-16"/>
    </div>

    <x-button id="editTask" caption="Edit" onClick="showTaskModal('{{$task->id}}');" className="font-medium w-[60px] !px-2 py-1 line-1 self-end border-none bg-blue-500 hover:bg-blue-700"/>

    <p class="flex justify-between items-center my-0 p-2 text-xs whitespace-normal">
        <span>{{ $task->updated_at->format('d M Y') ?? "N/A" }}</span>
        <span class="text-right">{{ $task?->user?->name ?? "N/A" }}</span>
    </p>
</div>
