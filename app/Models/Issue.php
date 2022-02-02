<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'os',
        'assignee',
        'github_link',
        'trello_ref',
        'version',
        'steps_to_reproduce',
        'user_discord_id',
        'status_id',
        'category_id',
        'type_id',
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

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
