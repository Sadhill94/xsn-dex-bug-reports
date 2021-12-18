<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory, Uuids;

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
