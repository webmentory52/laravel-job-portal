<?php

namespace App\Library\Enums;

enum JoinRequestStatusEnum : string
{
    case Accepted = 'accepted';
    case Pending = 'pending';
    case Rejected = 'rejected';
}
