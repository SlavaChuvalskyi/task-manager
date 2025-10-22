<div class="flex justify-between py-2 px-4 h-[60px] bg-white border-b-3 border-b-[#f4f7f6]">
    <x-search />
    <div id="menu-toggle" class="grid grid-cols-[auto_1fr] items-center gap-x-2 relative cursor-pointer">
        <span class="p-2 bg-blue-600 rounded-full">
            <x-icon name="user" class="w-6 h-6 text-blue-950" />
        </span>

        <p class="grid">
            <span class="text-md font-medium">
                @if($user) {{ $user->name }} @else Anon @endif
            </span>
            @if($user ?? false)
                <span class="text-sm">{{ $user->role}}</span>
            @endif
        </p>

        <!-- Menu -->
        <ul id="menu"
            class="hidden absolute top-[52px] right-[-1rem] min-w-[120px] w-full bg-white shadow-md">
            <li class="p-4 hover:shadow-sm rounded-md"><a href="#" class="block">Login</a></li>
            <li class="p-4 hover:shadow-sm rounded-md"><a href="#" class="block">Logout</a></li>
        </ul>
    </div>

</div>

<script>
    const toggleBtn = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');

    const clickWindowHandler = () => {
        menu.classList.toggle('hidden');
        window.removeEventListener('click', clickWindowHandler);
    }

    toggleBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();

        if (menu.classList.contains('hidden')) {
            window.addEventListener('click', clickWindowHandler);
        }
        else {
            window.removeEventListener('click', clickWindowHandler);
        }

        menu.classList.toggle('hidden');
    });

</script>
