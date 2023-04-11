<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //sert à charger toutes les tâches
    {
        //$tasks = Tasks::all(); sélectionne toutes les tâches de la table tâche
        $user = Auth::user(); //vérifie quel est ulitisateur connecté
        //$tasks = Task::where('user_id', $user->id)->get(); //je récupère les tâches de l'utilisateur connecté
        $tasks=$user->tasks()->get(); // variation de la ligne du dessus qui est faite grâce à la fonction de tâche Model
        return view('tasks.index', [
            'tasks' => $tasks
        ]); //retourne la vue indexde la variable tasks 
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
        //$task->user_id = Auth::id();
        $task->user()->associate(Auth::user()); //associe l'utilisateur conecté à la tâche
        $task->save();
        return redirect()->route('tasks.index')->with(['message'=>'Nouvelle tâche créée']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task) //affiche 
    {
        if ($task->user_id == Auth::id()) {//vérfie que la tâche dempandée est bien celle de l'user connecté
            return view('tasks.show', [
                'task' => $task
            ]);
        } else {
            return redirect()->route('tasks.index')->with(['message'=>'Non, môsieur !']);
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
        if ($task->user_id==Auth::id()){
        return view('tasks.form', [
            'task' => $task
        ]);
    }else{
        return redirect()->route('tasks.index')->with(['message'=>'Non, mösieur !']);
    }

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
        if($task->user_id==Auth::id()){
        $task->title = $request->title;
        $task->description = $request->description;
        $task->lieu = $request->lieu;
        $task->dueDate = $request->date;
        $task->save();
        return redirect()->route('tasks.index')->with(['message' => 'tâche modifiée avec succès']);}
        else{
            return redirect()->route('tasks.index')->with(['message'=>'Non, môsieur !']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task) //$task est un paramètre de Task
    {
        if ($task->user_id==Auth::id()) {
            $task->delete();
            return redirect()->route('tasks.index')->with(['message'=>'La tâche a bien été supprimée']);
        } else {
            return redirect()->route('tasks.index');
        }
    }
}