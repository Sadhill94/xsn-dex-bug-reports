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
    ];

    public function issueFiles()
    {
        return $this->hasMany(IssueFile::class);
    }

    public function status()
    {
        return $this->hasOne(IssueStatus::class);
    }
}
