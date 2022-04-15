<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'visitors';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'classroom', 'visited'];

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

    function visit($name, $classroom)
    {
        $visitor = $this->where('name', $name)
            ->where('classroom', $classroom)
            ->find();

        if ($visitor) {
            $visitor = $visitor[0];
            session()->set('name', $name);
            session()->set('classroom', $classroom);
            session()->set('admin', false);

            return $this->update($visitor['id'], ['visited' => $visitor['visited'] + 1]);
        } else {
            return $this->insert([
                'name' => $name,
                'classroom' => $classroom,
                'visited' => 1
            ]);
        }
    }
}
