<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkPlace extends Model
{
    protected $fillable = [
        "name"
    ];

    public function candidateJobs()
    {
        return $this->hasMany(CandidateJob::class);
    }
}
