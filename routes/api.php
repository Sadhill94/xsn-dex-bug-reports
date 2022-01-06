<?php

use App\Http\Controllers\IssueController;
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

    Route::post('/bug/create', [IssueController::class, 'create_bug'])
        ->name('create-bug');

    Route::post('/feature/create', [IssueController::class, 'create_feature'])
        ->name('create-feature');

    Route::post('/edit', [IssueController::class, 'edit'])
        ->middleware('auth')
        ->name('edit-issue');

    Route::delete('/{id}', [IssueController::class, 'delete'])
        ->middleware('auth')
        ->name('delete-issue');
});

Route::group(['prefix' => 'files'], function() {

Route::get('/download/{id}', [IssueController::class, 'download_file'])
    ->middleware('auth')
    ->name('download-file');

Route::delete('/{id}', [IssueController::class, 'delete_file'])
    ->middleware('auth')
    ->name('delete-file');

Route::post('', [IssueController::class, 'add_single_file'])
    ->middleware('auth')
    ->name('add-single-file');
});
