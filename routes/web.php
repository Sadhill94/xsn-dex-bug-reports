<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\IssueController;
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

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


Route::group(['prefix' => '/'], function() {

    Route::get('/', [IssueController::class, 'home'])
        ->name('home');

    Route::get('report-a-bug', [IssueController::class, 'report_a_bug'])
        ->name('bug-report');

    Route::get('feature-request', [IssueController::class, 'feature_request'])
        ->name('feature-request');

    Route::get('dashboard', [IssueController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('contribute', function(){
        return Inertia::render('Contribute/index');
    })->name('contribute');


    // legal
    Route::get('legal/privacy-policy', function(){
        return Inertia::render('Legal/privacy-policy');
    })->name('privacy-policy');

    Route::get('legal/terms-of-use', function(){
        return Inertia::render('Legal/terms-of-use');
    })->name('terms-of-use');
});

Route::group(['prefix' => 'issues'], function(){

    Route::get('/{id}', [IssueController::class, 'display'])
        ->name('display-issue');

    Route::get('/edit/{id}', [IssueController::class, 'display_edit'])
        ->middleware('auth')
        ->name('display-edit-issue');
});

