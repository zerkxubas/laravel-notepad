<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashedNoteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Creating Notes Resource Route for authenticated users.
    Route::resource('/notes', NoteController::class);

    // Creating Trash or Archive Route for soft deleted items.
    Route::get('/trash/notes', [TrashedNoteController::class,'index'])->name('trash.view');
    Route::get('/trash/notes/{uuid}', [TrashedNoteController::class,'show'])->name('trash.show');
    Route::patch('/trash/notes/{uuid}', [TrashedNoteController::class,'update'])->name('trash.update');
    Route::delete('/trash/notes/{uuid}', [TrashedNoteController::class,'destroy'])->name('trash.destroy');

});



require __DIR__.'/auth.php';
