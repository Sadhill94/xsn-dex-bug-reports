<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IssueController;
use App\Models\Category;
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

Route::get('/', [IssueController::class, 'public_active'])
    ->name('home');

Route::group(['prefix' => 'report-a-bug'], function(){
    Route::get('/', [IssueController::class, 'showReportBug'])
    ->name('bug-report');
});

Route::group(['prefix' => 'dashboard'], function(){
    Route::get('/', [IssueController::class, 'index'])
        ->name('dashboard');
});

Route::group(['prefix' => 'issues'], function(){
    Route::get('/', [IssueController::class, 'list'])
        ->name('list-issues');

    Route::post('/create', [IssueController::class, 'create'])
        ->name('create-issue');

    Route::post('/edit', [IssueController::class, 'edit'])
        ->name('edit-issue');

    Route::delete('/{id}', [IssueController::class, 'delete'])
        ->name('delete-issue');
});

