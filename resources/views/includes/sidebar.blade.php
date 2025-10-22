<div class="grid auto-rows-min grid-cols-[240px] px-2 py-4 bg-white border-r-2 border-r-[#f4f7f6]">
    <div class="flex align-center h-min">
        <a href="/" class="flex decoration-0">
            <x-icon name="grid" class="w-10 h-10 text-blue-950" />
            <h2 class="my-auto text-xl font-semibold ml-2">
                Task Manager
            </h2>
        </a>
    </div>

    <x-modal id="createProjectModal" title="Create New Project">
        @include('project/new')
    </x-modal>

    <x-button caption="+ Create Project" onClick="toggleModal('createProjectModal', true)" className="mt-8 mb-4 h-min p-2 border-none font-medium bg-blue-500 hover:bg-blue-700"/>

    <div class="grid gap-2 mt-8">
        <p>PROJECTS</p>
        @include('project/list', $projects)
    </div>
</div>
