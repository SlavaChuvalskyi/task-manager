<form method="POST" onsubmit="onSubmitForm(event, 'createProjectModal')" action="{{ route('project.store') }}" class="space-y-4">
    @csrf

    <x-input name="title" id="title" label="Project Title" autofocus="true" required/>

    <x-input name="description" id="description" label="Project Description" />

    <div class="relative">
        <x-spinner/>
        <div class="flex justify-end w-full space-x-2 footer">
            <x-button caption="Cancel" onClick="toggleModal('createProjectModal', false)" />
            <x-button caption="Save Project" type="submit" className="bg-blue-600 text-white"/>
        </div>
    </div>

</form>
