<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\IssueController;
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

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


Route::group(['prefix' => 'manager'], function() {
    Route::get('/dashboard', [IssueController::class, 'manager'])
    ->middleware('auth')
    ->name('manage');
});

Route::get('/contribute', [IssueController::class, 'contributors'])
    ->name('contribute');


Route::get('/', [IssueController::class, 'public_active'])
    ->name('home');

Route::group(['prefix' => 'report-a-bug'], function(){
    Route::get('/', [IssueController::class, 'showReportBug'])
        ->name('bug-report');
});

Route::group(['prefix' => 'issues'], function(){
    Route::get('/', [IssueController::class, 'list'])
        ->name('list-issues');

    Route::post('/create', [IssueController::class, 'create'])
        ->middleware('auth')
        ->name('create-issue');

    Route::post('/edit', [IssueController::class, 'edit'])
        ->middleware('auth')
        ->name('edit-issue');

    Route::delete('/{id}', [IssueController::class, 'delete'])
        ->middleware('auth')
        ->name('delete-issue');
});

