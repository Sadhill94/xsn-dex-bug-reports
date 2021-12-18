<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
