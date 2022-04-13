<?php

namespace App\Models;

use CodeIgniter\Model;

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
    protected $allowedFields    = ['name', 'category_id', 'author', 'year'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'int';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name'           => 'required',
        'category_id'    => 'required|is_natural',
        'author'         => 'required',
        'year'           => 'required|is_natural|min_length[4]|max_length[4]',
    ];
    protected $validationMessages   = [
        'name'           => [
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
            ->select('books.id, books.name, c.name category, books.author, books.year, CONCAT(v.classroom, "-", v.name) loaned_to, l.created_at loaned_at, l.created_at + (7*86400) returns_in')
            ->from('books', true)
            ->join('loans l', 'books.id=l.book_id', 'left')
            ->join('visitors v', 'l.loaned_to=v.id', 'left')
            ->join('categories c', 'books.category_id=c.id', 'left')
            ->orderBy('l.loaned_to', 'DESC')
            ->orderBy('books.name');
    }
}
