<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    protected $fillable = [
        "name"
    ];

    public function candidateJobs()
    {
        return $this->hasMany(CandidateJob::class);
    }
}
