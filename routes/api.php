<?php

use App\Http\Controllers\FilesController;
use App\Http\Controllers\IssuesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'issues'], function() {

    Route::post('/bug/create', [IssuesController::class, 'create_bug'])
        ->name('create-bug');

    Route::post('/feature/create', [IssuesController::class, 'create_feature'])
        ->name('create-feature');

    Route::post('/edit', [IssuesController::class, 'edit'])
        ->middleware('auth')
        ->name('edit-issue');

    Route::delete('/{id}', [IssuesController::class, 'delete'])
        ->middleware('auth')
        ->name('delete-issue');
});

Route::group(['prefix' => 'files'], function() {

Route::get('/download/{id}', [FilesController::class, 'download'])
    ->middleware('auth')
    ->name('download-file');

Route::delete('/{id}', [FilesController::class, 'delete'])
    ->middleware('auth')
    ->name('delete-file');

Route::post('', [FilesController::class, 'add_single'])
    ->middleware('auth')
    ->name('add-single-file');
});
