  <x-app-layout>
      <x-slot name="header">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('Dashboard') }}
          </h2>
      </x-slot>

      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <div class="relative p-6 bg-white border-b border-gray-200">
                      <h1 class="border-solid border-b border-gray-700 m-1 w-52 text-center text-lg font-bold">Mon
                          Tableau de Tâches</h1>
                      @if (session('message'))
                          <div class="absolute top-0 right-0 py-2 px-10 uppercase text-black">
                              {{ session('message') }}
                          </div>
                      @endif
                      <button
                          class="border-solid border border-gray-700 rounded-xl px-1 py-1 m-2 w-32 font-bold hover:bg-green-600"
                          type="button"><a href="/tasks/create">Nouvelle Tâche</a></button>
                      <table>
                          @foreach ($tasks as $task)
                              {{-- pour chaque tâche dans la table tâches, affiche une tâche --}}
                              <tr>
                                  <td class="border-solid border border-gray-700 px-3 py-1">{{ $task->id }}</td>
                                  {{-- met l'ID dans la première colonne et ainsi de suite --}}
                                  <td class="border-solid border border-gray-700 px-3 py-1"><a
                                          href="/tasks/{{ $task->id }}">{{ $task->title }}</a></td>
                                  <td class="border-solid border border-gray-700 px-3 py-1">{{ $task->description }}
                                  </td>
                                  <td class="border-solid border border-gray-700 px-3 py-1">{{ $task->lieu }}</td>
                                  <td class="border-solid border border-gray-700 px-3 py-1">{{ $task->dueDate }}</td>
                                  <td class="border-solid border border-gray-700 px-3 py-1"><?php if ($task->status == true) {
                                      echo 'Fait';
                                  } else {
                                      echo 'À faire';
                                  } ?></td>
                                  <td class="border-solid border border-gray-700 px-3 py-1 text-blue-700"><a
                                          href="/tasks/{{ $task->id }}/edit">Modfier</a></td>
                                  <td class="border-solid border border-gray-700 px-3 py-1 text-red-500"><a
                                          href="/tasks/{{ $task->id }}/destroy">Supprimer</a></td>
                              </tr>
                          @endforeach
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </x-app-layout>
