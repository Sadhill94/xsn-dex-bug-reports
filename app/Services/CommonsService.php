<?php

namespace App\Services;

use App\Repository\CommonsRepository ;
use Illuminate\Support\Facades\Config;


class CommonsService
{
    protected $commonsRepository;

    public function __construct(CommonsRepository $commonsRepository)
    {
        $this->commonsRepository = $commonsRepository;
    }

    public function isManager()
    {
        $user = auth()->user();
        if($user) {
            return $user->role == Config::get('constants.roles.manager');
        }
        return false;
    }

    public function getStatuses()
    {
        return $this->commonsRepository->getStatuses();
    }

    public function getCategories()
    {
        return $this->commonsRepository->getCategories();
    }

    public function getTypes()
    {
        return $this->commonsRepository->getTypes();
    }

    public function getTypeById($id)
    {
        return $this->commonsRepository->getTypeById($id);
    }

    public function getTypeByName($name)
    {
        return $this->commonsRepository->getTypeByName($name);
    }

    public function getToValidateStatus()
    {
        return $this->commonsRepository->findStatusByName(Config::get('constants.statuses.to_validate'));
    }

    /**
     * Used to format an array of categories/statuses where we will store each category with its name, id and related issues
     * @param $items
     * @return array
     */
    public function formatPayload($items): array
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

    public function filterStatusNameBy($collection, $filterBy)
    {
        return $collection->filter(function($item) use ($filterBy){
            return $item->status->name == $filterBy;
        })->values();
    }
}
