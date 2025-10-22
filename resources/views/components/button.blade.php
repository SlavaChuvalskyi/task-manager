@props([
    'caption',
    'id' => null,
    'type' => 'button',
    'className' => 'border-stone-200',
    'onClick' => null,
])

<button id="{{ $id }}" type="{{ $type }}" onclick="{{ $onClick }}" class="px-4 py-2 border rounded-md cursor-pointer {{ $className }}">
    {{ $caption }}
</button>
