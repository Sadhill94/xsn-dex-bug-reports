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

    public function getIssuesByCategoriesAndStatuses(): array
    {
        $categories = self::getAllIssueCategories();
        $statuses = self::getAllIssueStatuses();

        $allIssuesByStatus = self::formatPayload($statuses);
        $allIssuesByCategory = self::formatPayload($categories);

        return [
            'issues_by_filter' => [
                'statuses' => collect($allIssuesByStatus),
                'categories' => collect($allIssuesByCategory),
            ]
        ];
    }

    public function create($data)
    {
        $to_validate_status = $this->issuesRepository->findStatusByName(Config::get('constants.statuses.to_validate'));
        $data['status_id'] = $to_validate_status->id;

        return $this->issuesRepository->create($data);
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
}
