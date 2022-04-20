<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\VisitorModel;

class BookModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'books';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'category_id', 'author', 'year'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'int';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'title'          => 'required',
        'category_id'    => 'required|is_natural',
        'author'         => 'required',
        'year'           => 'required|is_natural|min_length[4]|max_length[4]',
    ];
    protected $validationMessages   = [
        'title'          => [
            'required'   => 'Nama belum diisi',
        ],
        'category_id'    => [
            'required'   => 'Kategori belum dipilih',
            'is_natural' => 'Kategori belum dipilih',
        ],
        'author'         => [
            'required'   => 'Penulis belum diisi',
        ],
        'year'           => [
            'required'   => 'Tahun belum diisi',
            'is_natural' => 'Tahun harus diisi angka',
            'min_length' => 'Tahun tidak boleh kurang dari 4 angka',
            'max_length' => 'Tahun tidak boleh lebih dari 4 angka',
        ]
    ];
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

    function getAllBooks()
    {
        return $this
            ->select('b.id, b.title, c.name category, b.author, b.year, (l.created_at IS NOT NULL) loaned, CONCAT(v.name, " (", v.classroom, ")") loaned_to, l.created_at loaned_at, l.created_at + (7*86400) returns_in')
            ->from('books b')
            ->join('(SELECT * FROM loans WHERE deleted_at IS NULL) l', 'b.id=l.book_id', 'left')
            ->join('visitors v', 'l.loaned_to=v.id', 'left')
            ->join('categories c', 'b.category_id=c.id')
            ->groupBy('b.id', 'DESC');
    }

    function getBorrowedBooks()
    {
        $visitorModel = new VisitorModel();
        $visitor      = $visitorModel->getVisitor();

        return $this
            ->select('b.id, b.title, c.name category, b.author, b.year, CONCAT(v.name, " (", v.classroom, ")") loaned_to, l.created_at loaned_at, l.created_at + (7*86400) returns_in')
            ->from('loans l')
            ->join('books b', 'l.book_id=b.id', 'left')
            ->join('visitors v', 'l.loaned_to=v.id', 'left')
            ->join('categories c', 'b.category_id=c.id', 'left')
            ->where('l.loaned_to', $visitor->id)
            ->where('l.deleted_at', null)
            ->groupBy('l.id', 'DESC');
    }
}
