<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<?= $this->include('visitor/navbar'); ?>

<?php helper('date'); ?>

<div class="container-fluid">
    <?php if ($toast = session()->getFlashdata('toast')) : ?>
        <div class="position-relative">
            <div class="toast-container position-absolute top-0 start-0 p-3 pt-0" style="z-index: 11;" id="toastPlacement">
                <div class="toast bg-success text-white" style="z-index: 11;">
                    <div class="toast-header">
                        <strong class="me-auto"><?= $toast['title']; ?></strong>
                        <small>Baru saja</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?= $toast['message']; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row mt-4 justify-content-end">
        <div class="col-lg-4 col-md-6 col-sm-8">
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="3">Pengguna saat ini</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td class="text-end">:</td>
                        <td><?= $visitor->name; ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td class="text-end">:</td>
                        <td><?= $visitor->classroom; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <?= $pager->links('default', 'bootstrap'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 4%;" class="text-center">#</th>
                        <th scope="col" style="width: 28%;">Judul Buku</th>
                        <th scope="col" style="width: 9%;">Kategori</th>
                        <th scope="col" style="width: 12%;">Penulis</th>
                        <th scope="col" style="width: 5%;" class="text-center">Tahun Terbit</th>
                        <th scope="col" style="width: 14%;" class="text-center">Dipinjam?</th>
                        <th scope="col" style="width: 8%;" class="text-center">Tanggal Pinjam</th>
                        <th scope="col" style="width: 8%;" class="text-center">Tanggal Kembali</th>
                        <th scope="col" style="width: 12%;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = (($page - 1) * 20) + 1; ?>
                    <?php if (!$bookList) : ?>
                        <tr>
                            <td class="text-center" colspan="9">Belum ada data buku</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($bookList as $b) : ?>
                        <tr style="height: 66px;">
                            <td class="align-middle text-center"><?= $i++; ?></td>
                            <td class="align-middle"><?= $b->title; ?></td>
                            <td class="align-middle"><?= $b->category; ?></td>
                            <td class="align-middle"><?= $b->author; ?></td>
                            <td class="align-middle text-center"><?= $b->year; ?></td>
                            <?php if ($b->loaned) : ?>
                                <td class="align-middle text-center"><?= 'Sedang dipinjam'; ?></td>
                                <td class="align-middle text-center"><?= 'Jam ' . str_replace(' ', "<br>", unixToHumanFull($b->loaned_at)); ?></td>
                                <td class="align-middle text-center"><?= unixToHumanDate($b->returns_in); ?></td>
                            <?php else : ?>
                                <td class="align-middle text-center">Tidak</td>
                                <td class="align-middle text-center">-</td>
                                <td class="align-middle text-center">-</td>
                            <?php endif; ?>
                            <td class="align-middle text-center">
                                <a href="#" data-book-id="<?= $b->id; ?>" data-book-title="<?= $b->title; ?>" data-book-category="<?= $b->category; ?>" data-book-author="<?= $b->author; ?>" data-book-year="<?= $b->year; ?>" data-bs-toggle="modal" data-bs-target="#book_borrow" class="btn btn-sm btn-success w-100 btn-borrow <?= $b->loaned ? 'disabled' : ''; ?>"><i class="bi bi-journal-plus"></i> Pinjam</a>
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

<form id="book_borrow" action="<?= base_url('visitor/borrowbook/borrow'); ?>" method="post" class="modal" tabindex="-1">
    <input type="hidden" name="<?= csrf_token(); ?>" id="borrow_csrf" value="<?= csrf_hash(); ?>">
    <input type="hidden" name="book_id" id="borrow_book_id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pinjam buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td class="align-top" style="width: 100px;">Judul buku</td>
                        <td class="align-top"> : </td>
                        <td id="borrow_book_title"></td>
                    </tr>
                    <tr>
                        <td class="align-top">Kategori</td>
                        <td class="align-top"> : </td>
                        <td id="borrow_book_category"></td>
                    </tr>
                    <tr>
                        <td class="align-top">Penulis</td>
                        <td class="align-top"> : </td>
                        <td id="borrow_book_author"></td>
                    </tr>
                    <tr>
                        <td class="align-top">Tahun</td>
                        <td class="align-top"> : </td>
                        <td id="borrow_book_year"></td>
                    </tr>
                </table>
                <br>
                <p>Apakah Anda yakin ingin meminjam buku ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="width: 70px;" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-success" style="width: 70px;">Ya</button>
            </div>
        </div>
    </div>
</form>

<script>
    $('.btn-borrow').click(function() {
        $('#borrow_book_id').val($(this).data('book-id'));
        $('#borrow_book_title').html($(this).data('book-title'));
        $('#borrow_book_category').html($(this).data('book-category'));
        $('#borrow_book_author').html($(this).data('book-author'));
        $('#borrow_book_year').html($(this).data('book-year'));
    });
</script>

<?= $this->endSection('content'); ?>