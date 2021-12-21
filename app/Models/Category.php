<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Category extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name',
    ];

    public function issues()
    {
        return $this->hasMany(Issue::class)->with('status')->get();
    }

    public function issuesForContributors()
    {
        $status = Status::where('name', '=',Config::get('constants.statuses.to_validate'))->first();
        return $this->hasMany(Issue::class)
            ->with('status')
            ->where('status_id', '!=', $status->id)
            ->get();
    }
}
