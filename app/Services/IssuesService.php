<?php

namespace App\Services;

use App\Repository\IssuesRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

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

    public function getStatuses(){
        return $this->issuesRepository->getStatuses();
    }

    public function getCategories(){
        return $this->issuesRepository->getCategories();
    }

    public function getAllIssues(){
        return $this->issuesRepository->getAll();
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
        $to_validate_status = $this->issuesRepository->findStatusByName(Config::get('constants.statuses.to_validate'));

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
        $to_validate_status = $this->issuesRepository->findStatusByName(Config::get('constants.statuses.to_validate'));

        $public_issues = $this->issuesRepository->getIssuesWithCategoryAndStatusWhereNotIn('status_id', [$to_validate_status->id]);

        return [
            'all' => $public_issues,
            'open' => self::filterByOpenStatus($public_issues),
            'in_progress' => self::filterByInProgress($public_issues),
            'closed' => self::filterByClosed($public_issues),
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
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $this->issuesRepository->createFile($fileName, $filePath, $issueId);
        }
    }


    /*
    |--------------------------------------------------------------------------
    |   Create / Edit / Delete
    |--------------------------------------------------------------------------
    */

    public function create($data)
    {
        $to_validate_status = $this->issuesRepository->findStatusByName(Config::get('constants.statuses.to_validate'));
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
                    'items' => $item->issues()
                ];
        }
        return $formattedPayload;
    }

    /*
    |--------------------------------------------------------------------------
    |   Filters
    |--------------------------------------------------------------------------
    */

    private function filterByOpenStatus($collection)
    {
        return $collection->filter(function($item){
            return $item->status->name == Config::get('constants.statuses.open');
        })->values();
    }

    private function filterByInProgress($collection)
    {
        return $collection->filter(function($item){
            return $item->status->name == Config::get('constants.statuses.in_progress');
        })->values();
    }

    private function filterByClosed($collection)
    {
        return $collection->filter(function($item){
            return $item->status->name == Config::get('constants.statuses.closed');
        })->values();
    }
}
