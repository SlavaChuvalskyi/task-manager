@php
    /**
     * @var array $tasks
     */
    $taskModalTitle = !$tasks ? "Create Your First Project Task" : "Create Project Task";
@endphp

@extends('layouts.app')
@section('content')
    <div class="flex flex-col p-4">
        <div class="flex justify-between gap-x-8">
            <div class="flex flex-col">
                <h2 class="text-xl font-semibold">
                    {{$project->title}}
                </h2>
                <p class="text-lg my-2">{{$project->description}}</p>
            </div>`
            <div class="flex justify-end flex-[0_0_40%]">
                <form id="project_destroy" method="POST" action="{{ route('project.destroy', $project) }}" class="space-y-4 mr-4">
                    @csrf
                    <div class="relative">
                        <x-spinner/>
                        <div class="flex justify-end w-full space-x-2 footer">
                            <x-button caption="Remove Project" type="submit" className="bg-green-100 text-black border-none hover:bg-green-200 hover:shadow"/>
                        </div>
                    </div>
                </form>
                <x-button caption="+ Create Task" onClick="toggleModal('createTaskModal', true)"
                          className="max-w-[250px] font-medium h-min min-h-[40px] p-2 border-none bg-blue-500 hover:bg-blue-700 hover:shadow"/>

                <span class="ml-2 cursor-pointer" onClick="toggleModal('createFirstTaskModal', true);">
                    <x-icon name="help" className="hover:shadow"/>
                </span>
            </div>
        </div>

        @include('task/list', $project)

        <x-modal id="createTaskModal" title="{{$taskModalTitle}}"
                 wrapperClass="bg-transparent ml-[245px] !backdrop-blur-none">
            @include('task/new')
        </x-modal>

        @if (!$tasks || count($tasks) === 0)
            <x-modal id="createFirstTaskModal" title="{{$taskModalTitle}}"
                     wrapperClass="bg-transparent ml-[245px]">
                @include('task/firstTask')
            </x-modal>
        @endif

    </div>
@endsection

@push('scripts')
<script>
    const form = document.getElementById('project_destroy');
    form.addEventListener('submit', showSpinner);

    function showSpinner(e) {
        const form = e.target;

        const spinnerBlock = form.querySelector('div.loading');
        const footerBlock = form.querySelector('div.footer');
        if (spinnerBlock && footerBlock) {
            spinnerBlock.classList.remove('hidden');
            footerBlock.classList.add('hidden');
        }
    }
</script>
@endpush
