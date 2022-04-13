<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<?= $this->include('navbar-admin'); ?>

<?php

use CodeIgniter\I18n\Time;

?>

<div class="container-fluid">
    <div class="row my-4">
        <div class="col text-end">
            <a href="#" class="btn btn-primary">Tambah Buku Baru</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 50px;" class="text-center">#</th>
                        <th scope="col" style="width: 340px;">Nama Buku</th>
                        <th scope="col" style="width: 120px;">Kategori</th>
                        <th scope="col" style="width: 160px;">Penulis</th>
                        <th scope="col" style="width: 62px;" class="text-center">Tahun Terbit</th>
                        <th scope="col" class="text-center">Dipinjam?</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Kembali</th>
                        <th scope="col" style="width: 140px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = (($page - 1) * 20) + 1; ?>
                    <?php foreach ($bookList as $b) : ?>
                        <tr style="height: 66px;">
                            <td class="align-middle text-center"><?= $i++; ?></td>
                            <td class="align-middle"><?= $b->name; ?></td>
                            <td class="align-middle"><?= $b->category; ?></td>
                            <td class="align-middle"><?= $b->author; ?></td>
                            <td class="align-middle text-center"><?= $b->year; ?></td>
                            <td class="align-middle text-center"><?= str_replace('-', '<br>', $b->loaned_to ?? 'Tidak'); ?></td>
                            <td class="align-middle"><?= $b->loaned_at ? Time::createFromTimestamp($b->loaned_at)->toLocalizedString('HH:m d-MM-Y') : '-'; ?></td>
                            <td class="align-middle"><?= $b->returns_in ? Time::createFromTimestamp($b->returns_in)->toLocalizedString('d-MM-Y') : '-'; ?></td>
                            <td class="align-middle">
                                <a href="#" data-book-id="<?= $b->id; ?>" style="width: 58px;" class="btn btn-sm btn-success btn-edit">Edit</a>
                                <a href="#" data-book-id="<?= $b->id; ?>" style="width: 58px;" class="btn btn-sm btn-warning btn-delete">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $pager->links('default', 'bootstrap'); ?>
        </div>
    </div>
</div>

<form action="#" method="post" class="modal" tabindex="-1">
    <?= csrf_field(); ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Edit Buku</div>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection('content'); ?>