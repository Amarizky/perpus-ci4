<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<?= $this->include('navbar-admin'); ?>

<?php

use CodeIgniter\I18n\Time;

?>

<div class="container-fluid">
    <div class="row mt-4">
        <div class="col">
            <?= $pager->links('default', 'bootstrap'); ?>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col text-end">
            <a href="#" class="btn btn-primary">Tambah Buku Baru</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 52px;" class="text-center">#</th>
                        <th scope="col" style="width: 340px;">Nama Buku</th>
                        <th scope="col" style="width: 120px;">Kategori</th>
                        <th scope="col" style="width: 160px;">Penulis</th>
                        <th scope="col" style="width: 62px;" class="text-center">Tahun Terbit</th>
                        <th scope="col" class="text-center">Dipinjam?</th>
                        <th scope="col" style="width: 100px;">Tanggal Pinjam</th>
                        <th scope="col" style="width: 100px;">Tanggal Kembali</th>
                        <th scope="col" style="width: 150px;" class="text-center">Aksi</th>
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
                            <td class="align-middle"><?= $b->loaned_at ? 'Jam ' . str_replace(' ', "<br>", Time::createFromTimestamp($b->loaned_at)->toLocalizedString('HH:m d-MM-Y')) : '-'; ?></td>
                            <td class="align-middle"><?= $b->returns_in ? Time::createFromTimestamp($b->returns_in)->toLocalizedString('d-MM-Y') : '-'; ?></td>
                            <td class="align-middle text-center">
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

<form id="book_edit" action="<?= base_url('admin/book_edit') ?>" method="post" class="modal" data-bs-backdrop="static" tabindex="-1">
    <input type="hidden" name="csrf_test_name" id="csrf_edit" value="<?= csrf_hash(); ?>">
    <input type="hidden" name="book_id" id="book_id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Buku</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama buku">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="null" disabled selected>Pilih salah satu</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Masukkan nama penulis">
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Tahun</label>
                    <input type="number" class="form-control" id="year" name="year" placeholder="Masukkan tahun">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    var csrf = '<?= csrf_hash(); ?>';

    $('.btn-edit').click(function() {
        $.ajax({
            url: '<?= base_url('/admin/get_book_data'); ?>',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            type: 'post',
            data: {
                book_id: $(this).data('book-id'),
                <?= csrf_token(); ?>: csrf,
            },
            success: function(data) {
                data = JSON.parse(data);
                csrf = data.csrf;
                $('#csrf-edit').val(data.csrf);

                $('#book_id').val(data.id);
                $('#name').val(data.name);
                $('#category_id').val(data.category_id).change();
                $('#author').val(data.author);
                $('#year').val(data.year);
            },
        });

        $('#book_edit').modal('show');
    })
</script>

<?= $this->endSection('content'); ?>