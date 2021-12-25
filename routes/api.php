<?php

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\IssueController;
use Illuminate\Http\Request;
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

    Route::post('/create', [IssueController::class, 'create'])
        ->name('create-issue');

    Route::post('/edit', [IssueController::class, 'edit'])
        ->middleware('auth')
        ->name('edit-issue');

    Route::get('/list', [IssueController::class, 'list'])
        ->middleware('auth')
        ->name('list-issues');

    Route::delete('/{id}', [IssueController::class, 'delete'])
        ->middleware('auth')
        ->name('delete-issue');
});

Route::get('files/download/{id}', [IssueController::class, 'download_file'])
    ->name('download-file');

Route::delete('files/{id}', [IssueController::class, 'delete_file'])
    ->name('delete-file');
