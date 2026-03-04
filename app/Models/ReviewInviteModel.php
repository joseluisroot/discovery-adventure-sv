<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewInviteModel extends Model
{
    protected $table = 'review_invites';
    protected $primaryKey = 'id';
    protected $allowedFields = ['service_id','token','sent_at','responded_at'];
    protected $useTimestamps = true;
}
