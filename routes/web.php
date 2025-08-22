<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\DealController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('deals.index');
});

// Deals Routes
Route::get('/deals', [DealController::class, 'index'])->name('deals.index');
Route::get('/deals/featured', [DealController::class, 'featured'])->name('deals.featured');
Route::get('/deals/create', [DealController::class, 'create'])->name('deals.create')->middleware('auth');
Route::post('/deals', [DealController::class, 'store'])->name('deals.store')->middleware('auth');
Route::get('/deals/{deal}', [DealController::class, 'show'])->name('deals.show');
Route::get('/deals/{deal}/edit', [DealController::class, 'edit'])->name('deals.edit')->middleware('auth');
Route::put('/deals/{deal}', [DealController::class, 'update'])->name('deals.update')->middleware('auth');
Route::delete('/deals/{deal}', [DealController::class, 'destroy'])->name('deals.destroy')->middleware('auth');

Route::group(
    [
        'middleware' => 'trans',
        'prefix' => '{trans}',
        'as' => 'trans.',
        'where' => ['trans' => '[a-zA-Z]{2}'],
    ],
    function () {
        Route::get('/', 'ResourceController@home')->name('home');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        require __DIR__.'/auth.php';
    }
);

Route::group(
    [
        'prefix' => '{guard}',
        'as' => 'guard.',
        'where' => ['guard' => implode('|', array_keys(config('auth.guards')))],
        'middleware' => ['set.guard']
    ],
    function () {
        Route::get('/', [ResourceController::class, 'home'])->name('home');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        require __DIR__.'/auth.php';
    }
);
