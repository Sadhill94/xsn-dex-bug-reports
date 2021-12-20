<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\IssuesService;
use Illuminate\Http\Request;
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
       $public_issues = $this->issuesService->getOnlyPublicIssues();

       return Inertia::render('index', [
           'issues' => $public_issues
       ]);
   }

    public function showReportBug()
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
