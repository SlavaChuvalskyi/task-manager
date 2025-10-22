@props(['id' => 'modal', 'title' => 'Modal Title', 'wrapperClass' => '', 'blockClass' => ''])

<div
    id="{{ $id }}"
    class="fixed inset-0 z-50 hidden justify-center bg-black/50 backdrop-blur-sm {{ $wrapperClass }}"
>
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md h-max mx-auto overflow-hidden mt-[6rem] {{ $blockClass }}">
        <!-- Header -->
        <div class="flex justify-between items-center px-5 py-3 border-b-2 border-b-[#f4f7f6]">
            <h2 class="text-lg font-semibold text-gray-800">{{ $title }}</h2>
            <button
                type="button"
                onclick="toggleModal('{{ $id }}', false)"
                class="text-gray-500 hover:text-gray-800 text-xl leading-none cursor-pointer"
            >&times;</button>
        </div>

        <!-- Body -->
        <div class="p-5">
            {{ $slot }}
        </div>

        <!-- Footer -->
        @if (isset($footer))
            <div class="border-t bg-gray-50 px-5 py-3">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>

