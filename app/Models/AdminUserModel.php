<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminUserModel extends Model
{
    protected $table = 'admin_users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'name','email','password_hash','is_active','last_login_at'
    ];

    protected $useTimestamps = true;

    public function findActiveByEmail(string $email): ?array
    {
        return $this->where('email', $email)
            ->where('is_active', 1)
            ->first();
    }
}
