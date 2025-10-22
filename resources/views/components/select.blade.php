@props([
    'id' => null,
    'name',
    'options',
    'value' => "",
    'wrapperClass',
    'className',
    'label' => null,
    'disabledDefault',
    'placeholder' => '',
])

<div class="flex flex-col space-y-1 {{$wrapperClass}}">
    @if($label)
        <label for="{{ $id ?? $name }}" class="block text-lg font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif

    <select
        id="{{ $id ?? $name }}"
        name="{{ $name }}"
        {{ $attributes->merge(['class' => $className ]) }}
    >
        @if ($placeholder)
            <option value="" @selected($value === "") @if($disabledDefault) disabled @endif  >{{ $placeholder }}</option>
        @endif
        @foreach($options as $key => $text)
            <option value="{{ $key }}" @selected($value == $key)>
                {{ $text }}
            </option>
        @endforeach
    </select>

    <p data-error="{{ $name }}" class="text-sm text-red-500 mt-1 hidden"></p>
</div>
