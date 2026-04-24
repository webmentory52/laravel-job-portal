<?php

namespace App\Models;

use App\Library\Enums\JobApplicationStatusEnum;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
      "job_id",
        "user_id",
        "status",
        "cover_letter",
        "phone",
        "resume",
        "rejection_reason"
    ];

    public function candidateJob()
    {
        return $this->belongsTo(CandidateJob::class, 'job_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPending()
    {
        return $this->status === JobApplicationStatusEnum::Pending->value;
    }
}
