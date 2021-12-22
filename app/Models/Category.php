<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Category extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name',
    ];

    public function issues(): Collection
    {
        return $this->hasMany(Issue::class)->with('status')->get();
    }

    public function issuesForContributors(): Collection
    {
        $invalid_status = Status::where('name', '=',Config::get('constants.statuses.to_validate'))->first();
        return $this->hasMany(Issue::class)
            ->with('status')
            ->where('status_id', '!=', $invalid_status->id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }
}
