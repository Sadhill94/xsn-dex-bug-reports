<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'src',
        'issue_id',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

}
