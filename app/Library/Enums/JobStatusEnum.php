<?php

namespace App\Library\Enums;

enum JobStatusEnum : string
{
    case Approved = 'approved';
    case Pending = 'pending';
    case Rejected = 'rejected';
    case Expired = 'expired';
}
