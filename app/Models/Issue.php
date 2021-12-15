<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'os',
        'version',
        'steps_to_reproduce',
        'extra_infos',
        'user_discord_id',
        'status_id',
        'category_id',
    ];

    public function files()
    {
        return $this->hasMany(IssueFile::class);
    }

    public function status()
    {
        return $this->belongsTo(IssueStatus::class);
    }

    public function category()
    {
        return $this->belongsTo(IssueCategory::class);
    }
}
