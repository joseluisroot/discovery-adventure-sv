<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table      = 'services';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'customer_id','service_type','origin','destination',
        'service_date','service_time','passengers','status','notes'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'customer_id'  => 'required|is_natural_no_zero',
        'service_type' => 'required|max_length[50]',
        'origin'       => 'required|max_length[150]',
        'destination'  => 'required|max_length[150]',
        'service_date' => 'required|valid_date[Y-m-d]',
        'service_time' => 'required|regex_match[/^\d{2}:\d{2}$/]',
        'passengers'   => 'required|is_natural_no_zero|less_than_equal_to[99]',
        'status'       => 'required|in_list[pending,confirmed,completed,canceled]',
        'notes'        => 'permit_empty|max_length[1000]',
    ];

    protected $validationMessages = [
        'service_time' => [
            'regex_match' => 'La hora debe tener formato HH:MM (ej: 08:30).',
        ],
        'status' => [
            'in_list' => 'Estado inválido.',
        ],
    ];
}
