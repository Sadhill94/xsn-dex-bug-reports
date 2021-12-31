<?php

namespace App\Http\Controllers;

use App\Services\IssuesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
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
     * Get the issues formatted and render the manager view
     * @return Response
     */
    public function dashboard(): Response
    {
        $issues_by_filter = $this->issuesService->getIssuesByCategoriesAndStatuses();
        $issues = $this->issuesService->getAllIssuesWithoutValidateStatus();
        $categories = $this->issuesService->getCategories();
        $statuses = $this->issuesService->getStatuses();

        return Inertia::render('Dashboard/index', [
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
    public function home(): Response
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
    public function report_a_bug(): Response
    {
        return Inertia::render('ReportABug/index', [
            'categories' => $this->issuesService->getCategories()
        ]);
    }

    /**
     * Get the categories needed for the report page and render the view
     * @return Response
     */
    public function feature_request(): Response
    {
        return Inertia::render('FeatureRequest/index', [
            'categories' => $this->issuesService->getCategories()
        ]);
    }


    public function display_issue($id): Response
    {
        $issue = $this->issuesService->getById($id);

        if($issue->type->name ==Config::get('constants.types.feature')){
            return Inertia::render('404/index');
        }
        return Inertia::render('Issue/display', ['issue' => $issue]);
    }

    public function display_feature($id): Response
    {
        $issue = $this->issuesService->getById($id);

        if($issue->type->name == Config::get('constants.types.bug')){
                return Inertia::render('404/index');
        }

        return Inertia::render('Feature/display', ['feature' => $issue]);
    }


    public function display_edit_issue($id): Response
    {
        $issue = $this->issuesService->getById($id);

        if($issue->type->name ==Config::get('constants.types.feature')){
            return Inertia::render('404/index');
        }

        $categories = $this->issuesService->getCategories();
        $statuses = $this->issuesService->getStatuses();
        $types = $this->issuesService->getTypes();

        return Inertia::render('Issue/edit', [
            'issue' => $issue,
            'categories' => $categories,
            'statuses' => $statuses,
            'types' => $types,
            ]);
    }

    public function display_edit_feature($id): Response
    {
        $issue = $this->issuesService->getById($id);


        if($issue->type->name == Config::get('constants.types.bug')){
            return Inertia::render('404/index');
        }

        $categories = $this->issuesService->getCategories();
        $statuses = $this->issuesService->getStatuses();
        $types = $this->issuesService->getTypes();

        return Inertia::render('Feature/edit', [
            'feature' => $issue,
            'categories' => $categories,
            'statuses' => $statuses,
            'types' => $types,
        ]);
    }




    /**
    * Create an issue
    * Validate the files(if any) extensions
    * Sto
    * @param Request $request
    */
    public function create_bug(Request $request)
    {
        $messages = [
            "files.max" => "Maximum amount of files authorized is: 4",
            "files.*.mimes" => "File type unauthorized Only jpg,jpeg,png,log,txt and gifs",
            "files.*.max" => "File too big, maximum allowed is 2MB/file",
            "files.*.size" => "File too big, maximum allowed is 2MB/file",
        ];
        request()->validate([
            'description' => ['required'],
            'os' => ['required'],
            'version' => ['required'],
            'steps_to_reproduce' => ['required'],
            'user_discord_id' => ['required'],
            'category_id' => ['required'],
            'files.*' => ['mimes:jpg,jpeg,png,log,txt,gif|max:2000'],
            'files' => ['max:4'],
        ], $messages);

        $data = $request->post();
        if($request->file('files')){
            $data['files'] = $request->file('files');
        }
        $bug_type = $this->issuesService->getTypeByName(Config::get('constants.types.bug'));
        $data['type_id'] = $bug_type->id;

        $issue = $this->issuesService->create($data);

        return response([
            'message' => 'Issue successfully reported. Thanks',
            'data' => $issue
        ]);
    }

    public function create_feature(Request $request)
    {
        $messages = [
            "files.max" => "Maximum amount of files authorized is: 4",
            "files.*.mimes" => "File type unauthorized Only jpg,jpeg,png,log,txt and gifs",
            "files.*.max" => "File too big, maximum allowed is 2MB/file",
            "files.*.size" => "File too big, maximum allowed is 2MB/file",
        ];
        request()->validate([
            'description' => ['required'],
            'user_discord_id' => ['required'],
            'category_id' => ['required'],
            'files.*' => ['mimes:jpg,jpeg,png,log,txt,gif|max:2000'],
            'files' => ['max:4'],
        ], $messages);

        $data = $request->post();
        if($request->file('files')){
            $data['files'] = $request->file('files');
        }

        $feature_type = $this->issuesService->getTypeByName(Config::get('constants.types.feature'));
        $data['type_id'] = $feature_type->id;

        $issue = $this->issuesService->create($data);

        return response([
            'message' => 'Issue successfully created. Thanks',
            'data' => $issue
        ]);
    }

    /**
    * Edit an issue
    * Files aren't handled by this function, they are added or removed one by one
    * @param Request $request
    */
    public function edit(Request $request)
    {
        request()->validate([
            'description' => ['required'],
            'category_id' => ['required'],
            'status_id' => ['required'],
            'type_id' => ['required'],
        ]);

        $data = $request->post();
        $issue = $this->issuesService->edit($data);

        return response([
            'message' => 'Successfully edited.',
            'data' => $issue
        ]);
    }

    public function delete($id)
    {
        $this->issuesService->delete($id);
    }

    public function download_file($id)
    {
       return $this->issuesService->downloadFile($id);
    }

    public function delete_file($id)
    {
        return $this->issuesService->deleteFile($id);
    }

    public function add_single_file(Request $request)
    {
        $messages = [
            "files.max" => "Maximum amount of files authorized is: 4",
            "files.*.mimes" => "File type unauthorized Only jpg,jpeg,png,log,txt and gifs",
            "files.*.max" => "File too big, maximum allowed is 2MB/file",
            "files.*.size" => "File too big, maximum allowed is 2MB/file",
        ];

        request()->validate([
            'file.*' => ['mimes:jpg,jpeg,png,log,txt,gif|max:2000'],
            'files' => ['max:1'],
        ], $messages);

        if(!$request->file('file')){
            return response('No files submitted', 400);
        }
        $fileArray = $this->issuesService->storeFiles([$request->file('file')], $request->issue_id);

        return response($fileArray[0]);
    }
}
