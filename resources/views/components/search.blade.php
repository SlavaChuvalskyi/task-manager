@props(['placeholder' => 'Search tasks, projects, or team members...'])

<div class="flex items-center relative w-full max-w-sm border border-stone-200 rounded-md px-2 has-[input:focus]:ring-1 has-[input:focus]:ring-blue-500 has-[input:focus]:border-blue-500 ">
    <x-icon name="search" class="w-6 h-6 text-blue-950" />
    <x-input name="query" id="search" placeholder="{{$placeholder}}" className="px-2"/>
</div>
