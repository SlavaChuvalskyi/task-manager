<form method="POST" onsubmit="onSubmitForm(event, 'createTaskModal')" action="{{ route('project.task.store', $project) }}" class="space-y-4">
    @csrf

    <x-input label="Task Title" name="title" id="title" autofocus="true" required/>

    <x-textarea label="Task Description" name="description" id="description" required/>

    <x-select label="Assign To" name="assign_user_id" id="assign_user_id" disabledDefault="false" placeholder="Select user" :options="$users" />

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

    <div class="relative">
        <x-spinner/>
        <div class="flex justify-end w-full space-x-2 footer">
            <x-button caption="Cancel" onClick="toggleModal('createTaskModal', false)" />
            <x-button caption="Save Task" type="submit" className="bg-blue-600 text-white"/>
        </div>
    </div>

</form>
