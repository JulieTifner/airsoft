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
    Route::put('/users/{user}/approve', [App\Http\Controllers\UserController::class, 'approve'])->name('users.approve');    
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update'); 
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//events
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events');
Route::get('/event', [App\Http\Controllers\EventController::class, 'show'])->name('show');
Route::post('/update', [App\Http\Controllers\EventController::class, 'update'])->name('update');
Route::get('/enroll/{event}', [App\Http\Controllers\EventController::class, 'enroll'])->name('enroll');


Route::post('fullcalenderAjax', [App\Http\Controllers\EventController::class, 'ajax']);

