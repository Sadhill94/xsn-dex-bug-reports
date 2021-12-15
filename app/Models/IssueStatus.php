<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function issues()
    {
        return $this->belongsToMany(Issue::class);
    }
}