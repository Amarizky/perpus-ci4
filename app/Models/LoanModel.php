<?php

namespace App\Models;

use CodeIgniter\Model;
use \App\Models\VisitorModel;

class LoanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'loans';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['loaned_to', 'book_id'];

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

    function borrow($book_id = 0)
    {
        $visitorModel = new VisitorModel();
        $visitor = $visitorModel->getVisitor();

        $this->insert([
            'loaned_to' => $visitor->id,
            'book_id'   => $book_id,
        ]);
    }

    function return($book_id = 0)
    {
        $visitorModel = new VisitorModel();
        $visitor = $visitorModel->getVisitor();

        $this->where([
            'loaned_to' => $visitor->id,
            'book_id'   => $book_id,
        ])->delete();
    }
}
