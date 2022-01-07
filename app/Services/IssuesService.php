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
    protected $commonsService;
    protected $filesService;

    public function __construct(IssuesRepository $issuesRepository,FilesService $filesService, CommonsService $commonsService)
    {
        $this->issuesRepository = $issuesRepository;
        $this->filesService = $filesService;
        $this->commonsService = $commonsService;
    }

    public function getById($id)
    {
        $issue = $this->issuesRepository->getById($id);
        if(!$issue){
            throw new NotFoundHttpException();
        }
            return $issue;
    }

    public function getAllIssues()
    {
        return $this->issuesRepository->getAll();
    }

    public function getAllIssuesWithoutValidateStatus()
    {
        $to_validate_status = $this->commonsService->getToValidateStatus();

        return $this->issuesRepository->getIssuesWithCategoryAndStatusWhereNotIn('status_id', [$to_validate_status->id]);
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
        $to_validate_status = $this->commonsService->getToValidateStatus();

        $public_issues = $this->issuesRepository->getIssuesWithCategoryAndStatusWhereNotIn('status_id', [$to_validate_status->id]);

        $statusesNames = Config::get('constants.statuses');
        return [
            'all' => $public_issues,
            'open' => $this->commonsService->filterStatusNameBy($public_issues, $statusesNames['open']),
            'in_progress' => $this->commonsService->filterStatusNameBy($public_issues,$statusesNames['in_progress']),
            'in_review' => $this->commonsService->filterStatusNameBy($public_issues, $statusesNames['in_review']),
            'closed' => $this->commonsService->filterStatusNameBy($public_issues, $statusesNames['closed']),
        ];
    }

    /**
     * Get all categories and statuses, then proceed to format the payload (cf doc formatPayload)
     * Filtered output
     * @return array
     */
    public function getIssuesByCategoriesAndStatuses(): array
    {
        $categories = $this->commonsService->getCategories();
        $statuses = $this->commonsService->getStatuses();

        $allIssuesByStatus = $this->commonsService->formatPayload($statuses);
        $allIssuesByCategory = $this->commonsService->formatPayload($categories);

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
        $to_validate_status = $this->commonsService->getToValidateStatus();
        $type = $this->commonsService->getTypeById($data['type_id']);

        $data['status_id'] = $to_validate_status->id;

        $issue = $this->issuesRepository->create($data);

        if(Arr::exists($data, 'files')){
            $this->filesService->store_many($data['files'], $issue->id, $type->name);
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
                $this->filesService->delete($file->id);
            // case file already been deleted dunno how, we enforce the delete
            } catch(ErrorException $e){
                Log::error('Files already been deleted: '.$e->getMessage());
            }
        }

        return $this->issuesRepository->delete($id);
    }
}
