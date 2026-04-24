<?php

namespace App\Library\Enums;

enum JobApplicationStatusEnum : string
{
    case Pending = 'pending';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
}
