<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class IssueController extends Controller
{
    public function index()
    {
        return Inertia::render('/');
    }

   public function open()
   {
       return Inertia::render('OpenIssues/index');
   }
}