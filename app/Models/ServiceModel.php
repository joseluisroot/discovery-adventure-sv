<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'customer_id','service_type','origin','destination',
        'service_date','service_time','passengers','status','notes'
    ];
    protected $useTimestamps = true;
}
