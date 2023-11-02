<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function (\Illuminate\Http\Request $request) {
    if (!$request->user()) {
        return Inertia::render('App');
    } else {
        return redirect()->to('dashboard');
    }
})->name('/');

Route::get('/dashboard', function (\Illuminate\Http\Request $request) {

    return Inertia::render('Dashboard', [
        'urls' => $request->user()->urls()->withCount('clicks')->get()
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('url', \App\Http\Controllers\UrlController::class);

Route::get('/click/{prefix}', [\App\Http\Controllers\GotoUrlController::class, 'click'])
    ->name('click');

Route::get('/qr/{prefix}', [\App\Http\Controllers\GotoUrlController::class, 'qr'])
    ->name('qr');

Route::post('/find', \App\Http\Controllers\FindUrlController::class)
    ->name('find-url');



Route::get('images/logo-small.png', function () {
    return response()->file(public_path('images/logo-small.png'));
})->name('images.logoSmall');

require __DIR__.'/auth.php';
