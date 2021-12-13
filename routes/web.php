<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return Inertia::render('index');
})->name('/');

Route::get('/report-a-bug', function () {
    return Inertia::render('report-a-bug/index');
});

// Route::get('reported-issues', [IssueController::class, 'index'])->name('issue');
// Route::resource('employee', EmployeeController::class)->only(['index', 'store', 'update', 'destroy']);
