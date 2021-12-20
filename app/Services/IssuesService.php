<?php

namespace App\Services;

use App\Repository\IssuesRepository;
use Illuminate\Support\Facades\Config;

class IssuesService
{
    protected $issuesRepository;

    public function __construct(IssuesRepository $issuesRepository)
    {
        $this->issuesRepository = $issuesRepository;
    }

    public function getAllIssueStatuses(){
        return $this->issuesRepository->getStatuses();
    }

    public function getAllIssueCategories(){
        return $this->issuesRepository->getCategories();
    }

    public function getAllIssues(){
        return $this->issuesRepository->getAll();
    }

    public function getOnlyPublicIssues(){
        $closed_status = $this->issuesRepository->findStatusByName(Config::get('constants.statuses.to_validate'));
        $to_validate_status = $this->issuesRepository->findStatusByName(Config::get('constants.statuses.to_validate'));

        $issuesNotUnderValidationOrClosed = $this->issuesRepository->getIssuesWithCategoryAndStatusWhereNotIn('status_id', [$closed_status->id, $to_validate_status->id]);

        $public_issues = collect($issuesNotUnderValidationOrClosed)
            ->map(function($item) {
                if ($item->status->name == Config::get('constants.statuses.submitted_to_team')) {
                    // force for public to show open status instead of to validate/submitted to the team
                    $item->status->name = Config::get('constants.statuses.open');
                }
                return $item;
            });

        return [
            'all' => $public_issues,
            'open' => self::filterByOpenStatus($public_issues),
            'in_progress' => self::filterByInProgress($public_issues),
            'closed' => self::filterByClosed($public_issues),
        ];
    }


    public function getIssuesByCategoriesAndStatuses(): array
    {
        $categories = self::getAllIssueCategories();
        $statuses = self::getAllIssueStatuses();

        $allIssuesByStatus = self::formatPayload($statuses);
        $allIssuesByCategory = self::formatPayload($categories);

        return [
            'statuses' => $allIssuesByStatus,
            'categories' => $allIssuesByCategory,
        ];
    }

    public function create($data)
    {
        $to_validate_status = $this->issuesRepository->findStatusByName(Config::get('constants.statuses.to_validate'));
        $data['status_id'] = $to_validate_status->id;

        return $this->issuesRepository->create($data);
    }

    public function edit($data)
    {
        return $this->issuesRepository->edit($data);
    }

    public function delete($id)
    {
        return $this->issuesRepository->delete($id);
    }


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
