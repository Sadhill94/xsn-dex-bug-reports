<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Category;
use App\Models\Status;
use App\Services\IssuesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Inertia\Inertia;

class IssueController extends Controller
{
    protected $issuesService;

    public function __construct(IssuesService $issuesService)
    {
        $this->issuesService = $issuesService;
    }


    public function index()
    {
        $issues_by_filter = $this->issuesService->getIssuesByCategoriesAndStatuses();
        $issues = $this->issuesService->getAllIssues();
        $categories = $this->issuesService->getAllIssueCategories();

        return Inertia::render('Dashboard/index', [
            'issues' => $issues,
            'issues_by_filter' => $issues_by_filter,
            'categories' => $categories
            ]);
    }

    public function list()
    {
        $issues_by_filter = $this->issuesService->getIssuesByCategoriesAndStatuses();
        $issues = $this->issuesService->getAllIssues();
        $categories = $this->issuesService->getAllIssueCategories();

        return response([
            'issues' => $issues,
            'issues_by_filter' => $issues_by_filter,
            'categories' => $categories
        ]);
    }

   public function public_active()
   {
       $closed_status = Status::where('name', '=', Config::get('constants.statuses.closed'))->first();
       $to_validate_status = Status::where('name', '=', Config::get('constants.statuses.to_validate'))->first();

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

    public function categories()
    {
        return Inertia::render('ReportABug/index', [
            'categories' => Category::all()
        ]);
    }

    public function create(Request $request)
    {
        request()->validate([
            'description' => ['required'],
            'os' => ['required'],
            'version' => ['required'],
            'steps_to_reproduce' => ['required'],
            'user_discord_id' => ['required'],
            'category_id' => ['required'],
        ]);


        $data = $request->post();
        $issue = $this->issuesService->create($data);

        return response([
            'message' => 'Issue successfully reported. Thanks',
            'data' => $issue
        ]);
    }

    public function delete($id){
        $this->issuesService->delete($id);
    }
}
