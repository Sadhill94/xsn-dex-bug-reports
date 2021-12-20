<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Issue;
use App\Models\Status;

class IssuesRepository
{

    public function getCategories()
    {
        return Category::all();
    }

    public function getStatuses()
    {
        return Status::all();
    }

    public function getAll(){
         return Issue::orderBy('created_at', 'DESC')->with(['category', 'status'])->get();
    }
}
