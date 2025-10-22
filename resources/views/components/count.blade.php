@props([
    'id' => "",
    'count',
    'className' => 'flex items-center justify-center w-7 h-7 ml-2',
])

<span id="{{ $id }}" class="p-1 bg-gray-300 text-black rounded-sm {{ $className }}">{{$count}}</span>
