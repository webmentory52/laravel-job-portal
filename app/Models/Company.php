<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        "company_name",
        "website",
        "logo",
        "email",
        "bio"
    ];

    public function candidateJobs()
    {
        return $this->hasMany(CandidateJob::class, 'company_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'company_users', 'company_id', 'user_id')
                        ->withPivot('role')
                        ->withTimestamps();
    }

    public function applications()
    {
        return $this->hasManyThrough(JobApplication::class, CandidateJob::class, 'company_id', 'job_id');
    }

    public function joinRequests()
    {
        return $this->hasMany(JoinRequest::class, 'company_id');
    }
}
