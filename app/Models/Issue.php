<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'description',
        'os',
        'assignee',
        'github_link',
        'version',
        'steps_to_reproduce',
        'extra_infos',
        'user_discord_id',
        'status_id',
        'category_id',
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
