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

    public function issues($orderBy = 'DESC'): Collection
    {
        return $this->hasMany(Issue::class)
            ->with(['status', 'files', 'type'])
            ->orderBy('created_at', $orderBy)
            ->get();
    }
}
