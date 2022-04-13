<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'admins';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'password', 'session'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'int';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function verifyLogin($username = null, $password = null)
    {
        if (!$username && !$password) return false;

        $admin = $this->where('username', $username)->find()[0];

        if (password_verify($password, $admin->password)) {
            helper('text');
            $sessionToken = random_string('alnum', 64);
            $this->update($admin->id, ['session' => $sessionToken]);
            session()->set('session', $sessionToken);
            session()->set('admin', true);

            return true;
        }
        return false;
    }

    function check(): bool
    {
        return count($this->where('session', session()->get('session'))->limit(1)->find());
    }
}
