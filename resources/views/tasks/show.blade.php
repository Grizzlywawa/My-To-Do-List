<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Ma Tâche</h1>
                    <h2>Titre : {{ $task->title }}</h2>
                    <p>Description : {{ $task->description }}</p>
                    <p>Lieu : {{ $task->lieu }}</p>
                    <p>Date : {{ $task->dueDate }}</p>
                    <p>Statut : <?php if ($task->status == true) {
                        echo 'Fait';
                    } else {
                        echo 'À faire';
                    } ?></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
