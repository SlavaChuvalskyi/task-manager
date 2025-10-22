@props([
    'id' => null,
    'name',
    'type' => 'text',
    'value' => '',
    'wrapperClass' => 'w-full',
    'className' => 'border border-stone-200 rounded-md px-3 focus:ring-1 focus:ring-blue-500 focus:border-blue-500',
    'label' => null,
    'placeholder' => '',
    'required' => false,
    'autofocus' => null,
    'autocomplete' => null,
])

<div class="{{$wrapperClass}}">
    @if($label)
        <label for="{{ $id ?? $name }}" class="block text-lg font-medium text-gray-700 mb-1">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <input
        id="{{ $id ?? $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        @if($autofocus) autofocus="{{ $autofocus }}" @endif
        @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
        class="w-full py-2 text-gray-700 outline-none {{ $className ?? "" }}"
    />

    <p data-error="{{ $name }}" class="text-sm text-red-500 mt-1 hidden"></p>
</div>
