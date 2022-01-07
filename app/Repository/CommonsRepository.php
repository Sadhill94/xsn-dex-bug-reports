<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Status;
use App\Models\Type;

class CommonsRepository
{

    public function getTypeById($id)
    {
        return Type::findOrFail($id);
    }

    public function getTypeByName($name)
    {
        return Type::where('name', '=', $name)->first();
    }


    public function getCategories()
    {
        return Category::orderBy('order')->get();
    }

    public function getTypes()
    {
        return Type::all();
    }

    public function getStatuses()
    {
        return Status::orderBy('order')->get();
    }

    public function findStatusByName($name)
    {
        return Status::where('name', '=', $name)->first();
    }
}
