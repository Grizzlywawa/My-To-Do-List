<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //sert à charger toutes les tâches
    {
        $tasks = Task::all(); // variable tasks montre toute les colonnes de la table Task
        return view('tasks.index', [
            'tasks' => $tasks
        ]); //retourne la vue index de la variable tasks 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //afficher une fonction de création
    {
        return view('tasks.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //enregistre ce qui est créer
    {
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->lieu = $request->lieu;
        $task->dueDate = $request->date;
        $task->status = 0;
        $task->save();
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task) //affiche 
    {
        if ($task) {
            return view('tasks.show', [
                'task' => $task
            ]);
        } else {
            return back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.form', [
            'task' => $task
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->title = $request->title;
        $task->description = $request->description;
        $task->lieu = $request->lieu;
        $task->dueDate = $request->date;
        $task->save();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task) //$task est un paramètre de Task
    {
        if ($task) {
            $task->delete();
            return redirect()->route('tasks.index');
        } else {
            return redirect()->route('tasks.index');
        }
    }
}