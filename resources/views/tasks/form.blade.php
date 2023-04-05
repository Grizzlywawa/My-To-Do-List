<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col p-6 bg-white border-b border-gray-200">
                    <h1 class="border-solid border-b border-gray-700 m-1 w-40 text-center text-lg font-bold ">Nouvelle
                        tâche</h1>
                    @isset($task)
                        <form class="flex flex-col" action="/tasks/{{ $task->id }}/update" method="post">
                            @method('put')
                        @else
                            <form class="flex flex-col" action="/tasks/store" method="post">
                                @method('post')
                            @endisset
                            @CSRF {{-- Cross Site Request Forgery = créer une sécurité pour un formulaire --}}
                            <label class="m-1 underline" for="title">Titre</label>
                            <input class="m-1 w-64" type="text" name="title" placeholder="Titre"
                                @isset($task) value="{{ $task->title }}" @endisset>
                            {{-- @isset = vérifie s'il y a une tâche pour créer ou modifier une tâche @endisset, fin de la vérification --}}
                            <label class="m-1 underline" for="description">Description</label>
                            <textarea class="m-1 h-64 w-9/12" name="description" placeholder="Décrivez la tâche...">
                            @isset($task)
{{ $task->description }}
@endisset
                            </textarea>
                            <label class="m-1 underline" for="lieu">Lieu</label>
                            <input class="m-1 w-64" type="text" name="lieu" placeholder="Lieu"
                                @isset($task) value="{{ $task->lieu }}" @endisset>
                            <label class="m-1 underline" for="date">Date d'échéance</label>
                            <input class="m-1 w-40" type="date" name="date"
                                @isset($task) value="{{ $task->dueDate }}" @endisset>
                            <input
                                class="border-solid border border-gray-700 rounded-xl px-1 py-1 m-2 w-32 font-bold hover:bg-green-600"
                                type="submit" value="Valider">
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
