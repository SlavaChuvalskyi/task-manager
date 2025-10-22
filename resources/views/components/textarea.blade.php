<div class="flex flex-col space-y-1 {{ $wrapperClassName }}">
    @if($label)
        <label for="{{ $name }}" class="block text-lg font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        {{ $attributes->merge([
            'class' => $className
        ]) }}
    >
        {{ old($name, $value) }}
    </textarea>

    <p data-error="{{ $name }}" class="text-sm text-red-500 mt-1 hidden"></p>

</div>
