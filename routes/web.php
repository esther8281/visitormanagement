<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/visitor/dashboard', 'VisitorController@dashboard')->name('visitor.dashboard');
Route::get('/visitor/create', 'VisitorController@create')->name('visitor.create');
Route::get('/visitor/list', 'VisitorController@list')->name('visitor.list');
Route::post('/visitor/store', 'VisitorController@store')->name('visitor.store');
Route::post('/visitor/update/{visitor}', 'VisitorController@update')->name('visitor.update');
Route::get('/visitor/edit/{visitor}', 'VisitorController@edit')->name('visitor.edit');
Route::get('/visitor/delete/{visitor}', 'VisitorController@delete')->name('visitor.delete');
Route::get('/visitor/search', 'VisitorController@searchVisitor')->name('visitor.search');
Route::get('/visitor/searchByGraph', 'VisitorController@searchByGraph')->name('visitor.searchByGraph');
Route::get('/visitor/searchByDateRange', 'VisitorController@searchByDateRange')->name('visitor.searchByDateRange');

