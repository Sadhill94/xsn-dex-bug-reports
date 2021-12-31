<?php

namespace App\Services;

use App\Repository\IssuesRepository;
use ErrorException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function getById($id)
    {
        $issue = $this->issuesRepository->getById($id);
        if(!$issue){
            throw new NotFoundHttpException();
        }
            return $issue;
    }

    public function getStatuses()
    {
        return $this->issuesRepository->getStatuses();
    }

    public function getCategories()
    {
        return $this->issuesRepository->getCategories();
    }

    public function getTypes()
    {
        return $this->issuesRepository->getTypes();
    }

    public function getTypeByName($name)
    {
        return $this->issuesRepository->getTypeByName($name);
    }

    public function getAllIssues()
    {
        return $this->issuesRepository->getAll();
    }

    public function getAllIssuesWithoutValidateStatus()
    {
        $to_validate_status = self::getToValidateStatus();

        return $this->issuesRepository->getIssuesWithCategoryAndStatusWhereNotIn('status_id', [$to_validate_status->id]);
    }

    public function getToValidateStatus()
    {
        return $this->issuesRepository->findStatusByName(Config::get('constants.statuses.to_validate'));
    }


    /*
    |--------------------------------------------------------------------------
    |   Specific getters
    |--------------------------------------------------------------------------
    */
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
    |   Create / Edit / Delete Issue
    |--------------------------------------------------------------------------
    */

    public function create($data)
    {
        $to_validate_status = self::getToValidateStatus();
        $type = $this->issuesRepository->getTypeById($data['type_id']);

        $data['status_id'] = $to_validate_status->id;

        $issue = $this->issuesRepository->create($data);

        if(Arr::exists($data, 'files')){
            self::storeFiles($data['files'], $issue->id, $type->name);
        }

        return $issue;
    }

    public function edit($data)
    {
        return $this->issuesRepository->edit($data);
    }

    public function delete($id): int
    {
        $issue = self::getById($id);

        foreach ($issue->files as $file) {
            try {
                self::deleteFile($file->id);
            // case  file already been deleted dunno how, we enforce the delete
            } catch(ErrorException $e){
                Log::error('Files already been deleted: '.$e->getMessage());
            }
        }

        return $this->issuesRepository->delete($id);
    }

    /*
      |--------------------------------------------------------------------------
      |   Upload / Download / Delete File
      |--------------------------------------------------------------------------
      */
    /**
     * Upload file on the app's storage and then create the reference in the database
     * @param $files
     * @param $issueId
     */
    public function storeFiles($files, $issueId, $type = 'bug')
    {
        $storage_path = 'uploads/bug-reports';
        if($type != 'bug'){
            $storage_path = 'uploads/feature-requests';
        }

        $filesCreated = [];
        foreach ($files as $file) {
            $data['file_name'] = time().'_'.$file->getClientOriginalName();
            $data['display_name'] = $file->getClientOriginalName();
            $data['extension'] = $file->getClientOriginalExtension();
            $data['size'] = $file->getSize();
            $data['issue_id'] = $issueId;

            if($type == 'bug'){

            }
            $data['file_path'] = $file->storeAs($storage_path, $data['file_name'], 'public');

            array_push($filesCreated,$this->issuesRepository->createFile($data));
        }
        return $filesCreated;
    }

    public function deleteFile($id): bool
    {
        $file = $this->issuesRepository->getFileById($id);
        unlink(public_path().$file->file_path);

        return $this->issuesRepository->deleteFile($file->id);
    }

    public function downloadFile($id)
    {
        $file = $this->issuesRepository->getFileById($id);

        if($file){
            return response()->download(public_path().''.$file->file_path, $file->display_name);
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
