<?php

namespace App\Services;

use App\Repository\IssuesRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;

class IssuesService
{
    protected $issuesRepository;

    public function __construct(IssuesRepository $issuesRepository)
    {
        $this->issuesRepository = $issuesRepository;
    }

    /*
    |--------------------------------------------------------------------------
    |   Getters
    |--------------------------------------------------------------------------
    */


    public function getById($id){
        return $this->issuesRepository->getById($id);
    }

    public function getStatuses(){
        return $this->issuesRepository->getStatuses();
    }

    public function getCategories(){
        return $this->issuesRepository->getCategories();
    }

    public function getAllIssues(){
        return $this->issuesRepository->getAll();
    }

    public function getToValidateStatus(){
        return $this->issuesRepository->findStatusByName(Config::get('constants.statuses.to_validate'));
    }


    /*
    |--------------------------------------------------------------------------
    |   Specific getters
    |--------------------------------------------------------------------------
    */

    /**
     *  Returns all issues that haven't the to validate status.
     * Raw output
     */
    public function getOnlyContributorIssues(){
        $to_validate_status = self::getToValidateStatus();

        return  $this->issuesRepository->getIssuesWithCategoryAndStatusWhereNotIn('status_id', [$to_validate_status->id]);
    }

    /**
     * Get the issues for the contributing page
     * Doesn't take into account the issues that have a 'to validate' status
     * But since we have the sidebar on the left with the possibility to filter,
     * we must adapt the payload as same as the getIssuesByCategoriesAndStatuses, but without the to validate status issues
     * Filtered output
     * @return array
     */
    public function getIssuesByCategoriesAndStatusesForContributors(): array
    {
        $categories = self::getCategories();
        $statuses = self::getStatuses();

        $issues_by_categories = [];
        $issues_by_statuses = [];

        foreach ($categories as $category) {
            $issues_by_categories[$category->id] =
                [
                    'id' => $category->id,
                    'name' => $category->name,
                    'items' => $category->issuesForContributors()
                ];
        }
        foreach ($statuses as $status) {
            if($status->name != Config::get('constants.statuses.to_validate')) {
            $issues_by_statuses[$status->id] =
                [
                    'id' => $status->id,
                    'name' => $status->name,
                    'items' => $status->issuesForContributors()
                ];
            }
        }

        return [
            'statuses' => $issues_by_statuses,
            'categories' => $issues_by_categories,
        ];
    }

    /**
     * Get the issues for the home page
     * Doesn't take into account the issues that have a 'to validate' status
     * Filtered output
     * @return array
     */
    public function getOnlyPublicIssues(): array
    {
        $to_validate_status = self::getToValidateStatus();

        $public_issues = $this->issuesRepository->getIssuesWithCategoryAndStatusWhereNotIn('status_id', [$to_validate_status->id]);

        $statusesNames = Config::get('constants.statuses');
        return [
            'all' => $public_issues,
            'open' => self::filterStatusNameBy($public_issues, $statusesNames['open']),
            'in_progress' => self::filterStatusNameBy($public_issues,$statusesNames['in_progress']),
            'in_review' => self::filterStatusNameBy($public_issues, $statusesNames['in_review']),
            'closed' => self::filterStatusNameBy($public_issues, $statusesNames['closed']),
        ];
    }

    /**
     * Get all categories and statuses, then proceed to format the payload (cf doc formatPayload)
     * Filtered output
     * @return array
     */
    public function getIssuesByCategoriesAndStatuses(): array
    {
        $categories = self::getCategories();
        $statuses = self::getStatuses();

        $allIssuesByStatus = self::formatPayload($statuses);
        $allIssuesByCategory = self::formatPayload($categories);

        return [
            'statuses' => $allIssuesByStatus,
            'categories' => $allIssuesByCategory,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    |   File upload
    |--------------------------------------------------------------------------
    */

    /**
     * Upload file on the app's storage and then create the reference in the database
     * @param $files
     * @param $issueId
     */
    public function storeFiles($files, $issueId)
    {
        foreach ($files as $file) {
            $data['fileName'] = time().'_'.$file->getClientOriginalName();
            $data['display_name'] = $file->getClientOriginalName();
            $data['extension'] = $file->getClientOriginalExtension();
            $data['size'] = $file->getSize();
            $data['filePath'] = $file->storeAs('uploads', $data['fileName'], 'public');
            $data['issue_id'] = $issueId;
            $this->issuesRepository->createFile($data);
        }
    }

    public function deleteFile($id){
        $file = $this->issuesRepository->getFileById($id);
        Storage::delete($file->name);
    }


    /*
    |--------------------------------------------------------------------------
    |   Create / Edit / Delete
    |--------------------------------------------------------------------------
    */

    public function create($data)
    {
        $to_validate_status = self::getToValidateStatus();
        $data['status_id'] = $to_validate_status->id;

        $issue = $this->issuesRepository->create($data);

        if(Arr::exists($data, 'files')){
            self::storeFiles($data['files'], $issue->id);
        }

        return $issue;
    }

    public function edit($data)
    {
        return $this->issuesRepository->edit($data);
    }

    public function delete($id): int
    {
        return $this->issuesRepository->delete($id);
    }

    public function downloadFile($id){
        $file = $this->issuesRepository->getFileById($id);

        if($file){
            return response()->download(public_path().'/'.$file->file_path, $file->display_name);
        }
        return response('File not found', 404);
    }

    /**
     * Used to format an array of categories/statuses where we will store each category with its name, id and related issues
     * @param $items
     * @return array
     */
    private function formatPayload($items): array
    {
        $formattedPayload = [];

        foreach ($items as $item) {
            $formattedPayload[$item->id] =
                [
                    'id' => $item->id,
                    'name' => $item->name,
                    'items' => $item->issues($item->name == Config::get('constants.statuses.to_validate') ? 'ASC' : 'DESC')
                ];
        }
        return $formattedPayload;
    }

    /*
    |--------------------------------------------------------------------------
    |   Filters
    |--------------------------------------------------------------------------
    */
    private function filterStatusNameBy($collection, $filterBy)
    {
        return $collection->filter(function($item) use ($filterBy){
            return $item->status->name == $filterBy;
        })->values();
    }
}
