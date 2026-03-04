<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'invite_id',
        'rating_cleanliness','rating_comfort','rating_punctuality','rating_attention',
        'comment','language','score_total','published'
    ];
    protected $useTimestamps = true;
}
