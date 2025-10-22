@props([
    'className' => '',
])

<div class="flex justify-center items-center hidden h-8 py-2 text-black loading {{$className}}">
    <svg class="spinner h-8 w-8 mr-2 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
    </svg>
    <span>
        Processing…
    </span>
</div>
