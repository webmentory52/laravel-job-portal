<?php

namespace App\Models;

use App\Library\Enums\JobStatusEnum;
use Illuminate\Database\Eloquent\Model;

class CandidateJob extends Model
{
    protected $fillable = [
      "title",
       "location",
        "description",
        "salary",
        "company_id",
        "user_id",
        "category_id",
        "job_type_id",
        "work_place_id",
        "agreement_accepted",
        "expires_at",
        "status"
    ];

    protected function casts() : array
    {
        return [
            "description" => "json:unicode"
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, "job_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function workPlace()
    {
        return $this->belongsTo(WorkPlace::class);
    }

    public function scopeApproved($query)
    {
        $query->where('status', JobStatusEnum::Approved->value);
    }

    public function scopePending($query)
    {
        $query->where('status', JobStatusEnum::Pending->value);
    }

    public function scopeRejected($query)
    {
        $query->where('status', JobStatusEnum::Rejected->value);
    }

    public function isApproved()
    {
        return $this->status === JobStatusEnum::Approved->value;
    }

    public function isExpired()
    {
        return $this->status === JobStatusEnum::Expired->value;
    }

    public function hasUserApplied(int $userId) : bool {
        return $this->jobApplications()->where('user_id', $userId)->exists();
    }
}
