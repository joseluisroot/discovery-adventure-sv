<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $protectFields = true;
    protected $allowedFields = [
        'name',
        'phone',
        'email',
        'language',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[120]',
        'phone' => 'permit_empty|max_length[30]',
        'email' => 'permit_empty|valid_email|max_length[120]',
        'language' => 'required|in_list[es,en]',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'El nombre es obligatorio.',
        ],
        'email' => [
            'valid_email' => 'El correo no tiene un formato válido.',
        ],
        'language' => [
            'in_list' => 'El idioma debe ser es o en.',
        ],
    ];

}
