<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/tasks', [TaskController::class,'index'])->name('tasks.index'); // affiche l'index de la BDD
Route::get('/tasks/create', [TaskController::class, 'create']); //affiche le formulaire de création de tâche
Route::post('/tasks/store',[TaskController::class, 'store']); //envoie le formulaire rempli vers l'index
Route::get('/tasks/{task}', [TaskController::class, 'show']); //affiche les tâches de l'index
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name ('tasks.edit'); //pour modifier une tâche déjà existante
Route::put('tasks/{task}/update', [TaskController::class, 'update']); //pour mettre à jour une tâche modifiée
Route::get('tasks/{task}/destroy', [TaskController::class, 'destroy']); // pour supprimer une tâche