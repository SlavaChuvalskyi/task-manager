@php
    /**
     *  @var App\Models\Project $project
     *  @var App\Models\Task $task
     */
     $statuses = App\Enums\TaskStatus::options();
@endphp

<form method="POST" onsubmit="onSubmitForm(event, 'editTaskModal')" action="{{ route('project.task.update', ['project' => $project, 'task' => $task]) }}"
      class="space-y-4 relative">
    @csrf

    <x-input label="Task Title" name="title" id="title" value="{{ $task->title }}" autofocus="true" required/>

    <x-textarea label="Task Description" name="description" value="{{ $task->description }}" id="description" required/>

    <x-select label="Status" name="status" id="status" value="{{ $task->status }}" placeholder="Select Status"
              :options="$statuses"
              required/>

    <x-select label="Assign To" value="{{ $task->assign_user_id }}" name="assign_user_id" id="assign_user_id"
              disabledDefault="false" placeholder="Select user" :options="$users"/>

    <div class="relative">
        <x-spinner/>
        <div class="flex justify-between space-x-2 footer">
            <x-button caption="Delete" type="button" onClick="removeTaskModal()" className="bg-green-100 text-black border-none"/>
            <div class="flex justify-end w-full space-x-2">
                <x-button caption="Cancel" onClick="toggleModal('editTaskModal', false)"/>
                <x-button caption="Update Task" type="submit" className="bg-blue-600 text-white"/>
            </div>
        </div>
    </div>
</form>


@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            toggleModal('editTaskModal', true);
        });
    </script>
@endif
