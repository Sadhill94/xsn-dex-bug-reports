<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IssueController;
use App\Models\IssueCategory;
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

Route::get('report-a-bug', [IssueController::class, 'categories'])
    ->name('bug-report');

