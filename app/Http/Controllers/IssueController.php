<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\IssueStatus;
use Illuminate\Support\Facades\Config;
use Inertia\Inertia;

class IssueController extends Controller
{
    public function index()
    {
        return Inertia::render('', [
            'data' => Issue::all()
        ]);
    }

   public function public_active()
   {
       $closed_status = IssueStatus::where('name', '=', Config::get('constants.statuses.closed'))->first();
       $to_validate_status = IssueStatus::where('name', '=', Config::get('constants.statuses.to_validate'))->first();

       $public_issues = collect(Issue::whereNotIn('status_id', [$closed_status->id, $to_validate_status->id])
           ->with(['category', 'status'])
           ->get())
           ->map(function($item){
           if($item->status->name ==  Config::get('constants.statuses.submitted_to_team')){
               // force for public to show open status instead of to validate/submitted to the team
               $item->status->name = Config::get('constants.statuses.open');
           }
           return $item;
       });

       $filtered_issues = [
           'all' => $public_issues,
           'open' => collect($public_issues)->filter(function($item){
               return $item->status->name == Config::get('constants.statuses.open');
           })->values(),
           'in_progress' => collect($public_issues)->filter(function($item){
               return $item->status->name == Config::get('constants.statuses.in_progress');
           })->values(),
       ];

       return Inertia::render('index', [
           'issues' => $filtered_issues
       ]);

   }
}
