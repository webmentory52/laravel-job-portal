<?php

namespace App\Models;

use App\Library\Enums\JoinRequestStatusEnum;
use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    protected $fillable = [
      "company_id",
        "user_id",
        "status",
        "approved_at",
        "rejected_at"
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isPending()
    {
        return $this->status === JoinRequestStatusEnum::Pending->value;
    }

    public function isAccepted()
    {
        return $this->status === JoinRequestStatusEnum::Accepted->value;
    }

    public function isRejected()
    {
        return $this->status === JoinRequestStatusEnum::Rejected->value;
    }
}
