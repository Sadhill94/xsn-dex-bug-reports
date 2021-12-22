<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Status extends Model
{
    use HasFactory, Uuids;


    protected $fillable = [
        'name',
    ];

    public function issues()
    {
        return $this->hasMany(Issue::class)->with('category')->get();
    }

    public function issuesForContributors()
    {
        $invalid_status = Status::where('name', '=',Config::get('constants.statuses.to_validate'))->first();

        return $this->hasMany(Issue::class)
            ->with('category')
            ->where('status_id', '!=', $invalid_status->id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }
}
