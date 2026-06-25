<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/patient', [App\Http\Controllers\PatientController::class, 'index'])
        ->middleware('role:patient,praktijkmanagement')
        ->name('patient.index');

    Route::get('/mondhygienist', [App\Http\Controllers\MondhygienistController::class, 'index'])
        ->middleware('role:mondhygienist')
        ->name('mondhygienist.index');

    Route::get('/assistent', [App\Http\Controllers\AssistentController::class, 'index'])
        ->middleware('role:assistent')
        ->name('assistent.index');

    Route::get('/praktijkmanagement', [App\Http\Controllers\PraktijkmanagementController::class, 'index'])
        ->middleware('role:praktijkmanagement')
        ->name('praktijkmanagement.index');

    Route::get('/praktijkmanagement/gebruikersrollen', [App\Http\Controllers\PraktijkmanagementController::class, 'manageUserroles'])
        ->middleware('role:praktijkmanagement')
        ->name('praktijkmanagement.userroles');
    Route::get('/praktijkmanagement/gebruikersrollen/{user}', [App\Http\Controllers\PraktijkmanagementController::class, 'show'])
        ->middleware('role:praktijkmanagement')
        ->name('praktijkmanagement.userroles.show');
    Route::get('/praktijkmanagement/gebruikersrollen/{user}/edit', [App\Http\Controllers\PraktijkmanagementController::class, 'edit'])
        ->middleware('role:praktijkmanagement')
        ->name('praktijkmanagement.userroles.edit');
    Route::delete('/praktijkmanagement/gebruikersrollen/{user}', [App\Http\Controllers\PraktijkmanagementController::class, 'destroy'])
        ->middleware('role:praktijkmanagement')
        ->name('praktijkmanagement.userroles.destroy');

    Route::patch('/praktijkmanagement/gebruikersrollen/{user}', [App\Http\Controllers\PraktijkmanagementController::class, 'update'])
        ->middleware('role:praktijkmanagement')
        ->name('praktijkmanagement.userroles.update');
    Route::get('/tandarts', [App\Http\Controllers\TandartsController::class, 'index'])
        ->middleware('role:tandarts')
        ->name('tandarts.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
