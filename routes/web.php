<?php
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

//admin
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('/users', [App\Http\Controllers\UserController::class,'index'])->name('userlist');
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');    

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events');

Route::post('fullcalenderAjax', [App\Http\Controllers\EventController::class, 'ajax']);

