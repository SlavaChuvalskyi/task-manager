@php
    /**
     * @var array $tasks
    **/
@endphp

<div id="taskList" class="flex flex-wrap gap-8 mt-4">

    @include('task.listItem', ['items' =>  $tasks[App\Enums\TaskStatus::NEW->value] ?? collect(), 'status' => App\Enums\TaskStatus::NEW->value, 'title' => App\Enums\TaskStatus::NEW->label(), 'titleClassName' => 'text-blue-700'])

    @include('task.listItem', ['items' => $tasks[App\Enums\TaskStatus::IN_PROGRESS->value] ?? collect(), 'status' => App\Enums\TaskStatus::IN_PROGRESS->value, 'title' => App\Enums\TaskStatus::IN_PROGRESS->label(), 'titleClassName' => 'text-green-500'])

    @include('task.listItem', ['items' => $tasks[App\Enums\TaskStatus::REVIEW->value] ?? collect(), 'status' => App\Enums\TaskStatus::REVIEW->value, 'title' => App\Enums\TaskStatus::REVIEW->label(), 'titleClassName' => 'text-fuchsia-400'])

    @include('task.listItem', ['items' => $tasks[App\Enums\TaskStatus::COMPLETED->value] ?? collect(), 'status' => App\Enums\TaskStatus::COMPLETED->value, 'title' => App\Enums\TaskStatus::COMPLETED->label(), 'titleClassName' => 'text-green-500'])

    @include('task.listItem', ['items' => $tasks[App\Enums\TaskStatus::REJECTED->value] ?? collect(), 'status' => App\Enums\TaskStatus::REJECTED->value, 'title' => App\Enums\TaskStatus::REJECTED->label(), 'titleClassName' => 'text-red-600'])

    <x-modal id="editTaskModal" title="Project Task">
        <div id="loadingContainer">
            <div class="flex justify-center items-center h-full w-full min-h-[200px]">
                <x-spinner className="!flex"/>
            </div>
        </div>
        <div id="taskModalContainer"/>
    </x-modal>

</div>

@push('scripts')
    <script>

        const items = document.querySelectorAll('#taskList > div.status');

        let draggingEl = null;
        let taskStatus = null;
        let newTaskStatus = null;

        const updateTaskStatus = async (e) => {
            taskStatus = e.target.dataset.status;
            if (newTaskStatus && newTaskStatus !== taskStatus) {

                const statusContainer = document.getElementById('taskStatus_' + newTaskStatus);

                const clone = draggingEl.cloneNode(true);
                draggingEl.classList.add('opacity-20');
                clone.dataset.status = newTaskStatus;
                clone.classList.add('scale-[0.8]', 'opacity-60', 'border', 'border-dashed');

                const spinnerBlock = clone.querySelector('div.loading');
                spinnerBlock.classList.remove('hidden');

                statusContainer.appendChild(clone);

                if (statusContainer) {
                    const taskId = e.target.dataset.id;
                    e.preventDefault();
                    await fetch(('{{ $project->id }}/task/' + taskId + "/updateStatus"), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({status: newTaskStatus}),
                    })
                        .then((r) => {
                            clone.classList.remove('scale-[0.8]', 'scale-[0.7]', 'opacity-60', 'border', 'border-dashed', 'loading');
                            spinnerBlock.classList.add('hidden');

                            // Update the count of the tasks
                            const taskCountClone = document.getElementById('taskCount_' + newTaskStatus);
                            const taskCountDragging = document.getElementById('taskCount_' + taskStatus);
                            if (taskCountClone && taskCountDragging) {
                                taskCountClone.innerHTML = +(taskCountClone.innerHTML) + 1;
                                taskCountDragging.innerHTML -= 1;
                            }

                            draggingEl.remove();
                            draggingEl = null;
                        })
                        .catch(() => {
                            draggingEl.classList.remove('scale-[0.7]', 'opacity-20');
                            clone.remove();
                            console.log('Error occurred!!')
                        });
                }
            } else {
                e.target.classList.remove('scale-[0.7]');
            }
        }

        items.forEach(item => {

            // --- DRAG START ---
            item.addEventListener('dragstart', e => {
                draggingEl = e.target;
                e.target.classList.add('scale-[0.7]');
            });

            // --- DRAG END ---
            item.addEventListener('dragend', updateTaskStatus);

            item.addEventListener('dragover', e => {
                e.preventDefault(); // required to allow drop
                // optional: show some drop indicator
            });

            item.addEventListener('drop', e => {
                e.preventDefault();
                newTaskStatus = e.target.dataset.status;
            });
        });

        const showTaskModal = (taskId) => {
            // Show the modal
            toggleModal('editTaskModal', true);
            const loadingContainer = document.getElementById('loadingContainer');
            loadingContainer.classList.remove('hidden');

            const modalContainer = document.getElementById('taskModalContainer');
            modalContainer.innerHTML = "";

            fetch(`{{ $project->id }}/task/${taskId}`)
                .then(res => res.json())
                .then(data => {
                    // Insert HTML into modal container
                    loadingContainer.classList.add('hidden');
                    modalContainer.innerHTML = data.html;
                    // Open the modal form again to update handlers
                    toggleModal('editTaskModal', true);
                })
                .catch(err => {
                    toggleModal('editTaskModal', false);
                    console.error(err)
                });
        }

        function removeTaskModal() {
            const modal = document.getElementById('editTaskModal');
            if (!modal) return;

            const update_form = modal.querySelector('form');

            const spinnerBlock = update_form.querySelector('div.loading');
            spinnerBlock.classList.remove('hidden');

            const footerBlock = update_form.querySelector('div.footer');
            footerBlock.classList.add('hidden');

            update_form.action = update_form.action.replace("update", "destroy");

            update_form.submit();
        }

    </script>
@endpush
