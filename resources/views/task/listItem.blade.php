@props([
    'status',
    'items',
    'title',
    'titleClassName' => '',
])

<div id="taskStatus_{{$status}}" data-status="{{$status}}"
     class="flex flex-col px-2 py-4 w-full flex-[0_0_290px] min-h-[300px] bg-gray-100 rounded-md status">
    <h4 class="flex justify-between items-center mb-4 bg-white p-2 rounded-lg {{ $titleClassName }}">
        <span>{{ $title }}</span>
        <x-count id="taskCount_{{$status}}" count="{{count($items)}}"/>
    </h4>
    @foreach ($items as $item)
        @include('task.task', ['task' => $item])
    @endforeach
</div>
