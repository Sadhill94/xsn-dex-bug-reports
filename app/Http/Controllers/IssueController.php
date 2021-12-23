<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\IssuesService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class IssueController extends Controller
{
    protected $issuesService;

    public function __construct(IssuesService $issuesService)
    {
        $this->issuesService = $issuesService;
    }


    /**
     * Get the issues formatted and render the contributors view
     * @return Response
     */
    public function contributors(): Response
    {
        $issues_by_filter = $this->issuesService->getIssuesByCategoriesAndStatusesForContributors();
        $issues = $this->issuesService->getOnlyContributorIssues();

        $categories = $this->issuesService->getCategories();
        $statuses = $this->issuesService->getStatuses();

        return Inertia::render('Contribute/index', [
            'issues' => $issues,
            'issues_by_filter' => $issues_by_filter,
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    /**
     * Get the issues formatted and render the manager view
     * @return Response
     */
    public function manager(): Response
    {
        $issues_by_filter = $this->issuesService->getIssuesByCategoriesAndStatuses();
        $issues = $this->issuesService->getAllIssues();
        $categories = $this->issuesService->getCategories();
        $statuses = $this->issuesService->getStatuses();

        return Inertia::render('Manager/index', [
            'issues' => $issues,
            'issues_by_filter' => $issues_by_filter,
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    /**
     * Get the issues filtered without rendering a view
     */
    public function list()
    {
        $issues_by_filter = $this->issuesService->getIssuesByCategoriesAndStatuses();
        $issues = $this->issuesService->getAllIssues();
        $categories = $this->issuesService->getCategories();
        $statuses = $this->issuesService->getStatuses();

        return response([
            'issues' => $issues,
            'issues_by_filter' => $issues_by_filter,
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    /**
    * Get public issues and return the home view
    * @return Response
    */
    public function public_active(): Response
    {
       $public_issues = $this->issuesService->getOnlyPublicIssues();

       return Inertia::render('index', [
           'issues' => $public_issues
       ]);
    }

    /**
    * Get the categories needed for the report page and render the view
    * @return Response
    */
    public function showReportBug(): Response
    {
        return Inertia::render('ReportABug/index', [
            'categories' => $this->issuesService->getCategories()
        ]);
    }

    /**
    * Create an issue
    * Validate the files(if any) extensions
    * Sto
    * @param Request $request
    */
    public function create(Request $request)
    {
        $allowed_extensions = ['jpeg', 'jpg', 'png', 'gif', 'log', 'txt'];

        request()->validate([
            'description' => ['required'],
            'os' => ['required'],
            'version' => ['required'],
            'steps_to_reproduce' => ['required'],
            'user_discord_id' => ['required'],
            'category_id' => ['required'],
        ]);

        $data = $request->post();

        if($request->file('files')){
            foreach ($request->file('files') as $file) {
                $extension = $file->getClientOriginalExtension();
                if(!in_array($extension, $allowed_extensions)) {
                    return response(['message' => $extension.': file type not allowed'], 400);
                }
            }

            $data['files'] = $request->file('files');
        }


        $issue = $this->issuesService->create($data);

        return response([
            'message' => 'Issue successfully reported. Thanks',
            'data' => $issue
        ]);
    }

    /**
    * Edit an issue
    * Files aren't allowed for edit the original issue
    * @param Request $request
    */
    public function edit(Request $request)
    {
        request()->validate([
            'description' => ['required'],
            'os' => ['required'],
            'version' => ['required'],
            'steps_to_reproduce' => ['required'],
            'user_discord_id' => ['required'],
            'category_id' => ['required'],
            'status_id' => ['required'],
        ]);

        $data = $request->post();
        $issue = $this->issuesService->edit($data);

        return response([
            'message' => 'Issue successfully edited.',
            'data' => $issue
        ]);
    }

    public function delete($id){
        $this->issuesService->delete($id);
    }
}
