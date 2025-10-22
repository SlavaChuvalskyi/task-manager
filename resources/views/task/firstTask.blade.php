<div class="flex flex-col items-center justify-center bg-white border border-gray-200 rounded-2xl shadow-sm p-6 text-center max-w-md mx-auto mb-4">

    {{-- Icon --}}
    <div class="w-12 h-12 mb-4 flex items-center justify-center rounded-xl bg-blue-50">
        <x-icon name="task" class="w-8 h-8 text-blue-600" />
    </div>

    {{-- Title --}}
    <h2 class="text-lg font-semibold text-gray-800 mb-2">
        Ready to get organized?
    </h2>

    {{-- Description --}}
    <p class="text-gray-500 text-sm leading-relaxed">
        Your board is empty. Create your first task to start tracking your project progress
        and collaborating with your team.
    </p>

    <x-button caption=" + Create Your First Task" type="button" onClick="toggleModal('createFirstTaskModal', false);toggleModal('createTaskModal', true);" className="bg-blue-600 text-white py-3 mt-4"/>

    {{-- Quick Start Tips --}}
    <div class="mt-8 bg-blue-50 p-4 rounded-xl text-left w-full">
        <h3 class="font-medium text-gray-800 mb-3 text-sm">Quick Start Tips:</h3>
        <ul class="space-y-2 text-sm text-gray-600">
            <li class="flex items-start gap-2">
                <span class="text-blue-500 mt-0.5">✔️</span>
                Break down your project into manageable tasks
            </li>
            <li class="flex items-start gap-2">
                <span class="text-blue-500 mt-0.5">✔️</span>
                Assign tasks to team members with clear deadlines
            </li>
            <li class="flex items-start gap-2">
                <span class="text-blue-500 mt-0.5">✔️</span>
                Move tasks across columns as work progresses
            </li>
        </ul>
    </div>

</div>
