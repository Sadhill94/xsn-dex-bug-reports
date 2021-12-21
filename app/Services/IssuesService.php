<?php

namespace App\Services;

use App\Models\File;
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
        $closed_status = $this->issuesRepository->findStatusByName(Config::get('constants.statuses.closed'));
        $to_validate_status = $this->issuesRepository->findStatusByName(Config::get('constants.statuses.to_validate'));

        $public_issues = $this->issuesRepository->getIssuesWithCategoryAndStatusWhereNotIn('status_id', [$closed_status->id, $to_validate_status->id]);

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

    public function storeFiles($files, $issueId)
    {
        foreach ($files as $file) {
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $this->issuesRepository->createFile($fileName, $filePath, $issueId);
        }
    }

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
