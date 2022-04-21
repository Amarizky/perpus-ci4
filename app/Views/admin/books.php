<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<?= $this->include('admin/navbar'); ?>

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
    <div class="row mt-4">
        <div class="col">
            <?= $pager->links('default', 'bootstrap'); ?>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col text-end">
            <button class="btn btn-primary" onclick="$('form').each((i, e) => e.reset())" data-bs-toggle="modal" data-bs-target="#book_add">Tambah Buku Baru</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 4%;" class="text-center">#</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col" style="width: 9%;">Kategori</th>
                        <th scope="col" style="width: 12%;">Penulis</th>
                        <th scope="col" style="width: 5%;" class="text-center">Tahun Terbit</th>
                        <th scope="col" class="text-center">Dipinjam?</th>
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
                                <td class="align-middle text-center"><?= $b->loaned_to; ?></td>
                                <td class="align-middle text-center"><?= 'Jam ' . str_replace(' ', "<br>", unixToHumanFull($b->loaned_at)); ?></td>
                                <td class="align-middle text-center"><?= unixToHumanDate($b->returns_in); ?></td>
                            <?php else : ?>
                                <td class="align-middle text-center">Tidak</td>
                                <td class="align-middle text-center">-</td>
                                <td class="align-middle text-center">-</td>
                            <?php endif; ?>
                            <td class="align-middle text-center">
                                <a href="#" data-book-id="<?= $b->id; ?>" data-bs-toggle="modal" data-bs-target="#book_edit" style="width: 58px;" class="btn btn-sm btn-success btn-edit">Edit</a>
                                <a href="#" data-book-id="<?= $b->id; ?>" data-book-title="<?= $b->title; ?>" data-book-category="<?= $b->category; ?>" data-book-author="<?= $b->author; ?>" data-book-year="<?= $b->year; ?>" data-bs-toggle="modal" data-bs-target="#book_delete" style="width: 58px;" class="btn btn-sm btn-warning btn-delete">Hapus</a>
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

<form id="book_add" action="<?= base_url('admin/book_add'); ?>" method="post" class="modal needs-validation" tabindex="-1" novalidate>
    <input type="hidden" name="<?= csrf_token(); ?>" id="add_csrf" value="<?= csrf_hash(); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah buku baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php $error = session()->getFlashdata('errorFor') == 'add'; ?>
                <?php $errors = session()->getFlashdata('errors'); ?>
                <div class="mb-3">
                    <label for="add_title" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control <?= $error && isset($errors['title']) ? 'is-invalid' : ''; ?>" id="add_title" name="title" placeholder="Masukkan judul buku" value="<?= old('title'); ?>" required>
                    <?php if ($error && isset($errors['title'])) : ?>
                        <div class="text-danger">
                            <?= $errors['title']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="add_category_id" class="form-label">Kategori</label>
                    <select class="form-select <?= $error && isset($errors['category_id']) ? 'is-invalid' : ''; ?>" id="add_category_id" name="category_id">
                        <option value="" disabled selected>Pilih salah satu</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->id; ?>" <?= old('category_id') == $category->id ? 'selected' : ''; ?>><?= $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($error && isset($errors['category_id'])) : ?>
                        <div class="text-danger">
                            <?= $errors['category_id']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="add_author" class="form-label">Penulis</label>
                    <input type="text" class="form-control <?= $error && isset($errors['author']) ? 'is-invalid' : ''; ?>" id="add_author" name="author" placeholder="Masukkan nama penulis" value="<?= old('author'); ?>">
                    <?php if ($error && isset($errors['author'])) : ?>
                        <div class="text-danger">
                            <?= $errors['author']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="add_year" class="form-label">Tahun</label>
                    <input type="number" class="form-control <?= $error && isset($errors['year']) ? 'is-invalid' : ''; ?>" id="add_year" name="year" placeholder="Masukkan tahun" value="<?= old('year'); ?>">
                    <?php if ($error && isset($errors['year'])) : ?>
                        <div class="text-danger">
                            <?= $errors['year']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="width: 90px;" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" style="width: 90px;">Tambah</button>
            </div>
        </div>
    </div>
</form>

<form id="book_edit" action="<?= base_url('admin/book_edit'); ?>" method="post" class="modal" data-bs-backdrop="static" tabindex="-1">
    <input type="hidden" name="<?= csrf_token(); ?>" id="edit_csrf" value="<?= csrf_hash(); ?>">
    <input type="hidden" name="book_id" id="edit_book_id" value="<?= old('book_id'); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Buku</h5>
                <button id="btn_edit_close_1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php $error = session()->getFlashdata('errorFor') == 'edit'; ?>
                <?php $errors = session()->getFlashdata('errors'); ?>
                <div class="mb-3">
                    <label for="edit_title" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control <?= $error && isset($errors['title']) ? 'is-invalid' : ''; ?>" id="edit_title" name="title" placeholder="Masukkan judul buku" value="<?= old('title'); ?>">
                    <?php if ($error && isset($errors['title'])) : ?>
                        <div class="text-danger">
                            <?= $errors['title']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="edit_category_id" class="form-label">Kategori</label>
                    <select class="form-select <?= $error && isset($errors['category_id']) ? 'is-invalid' : ''; ?>" id="edit_category_id" name="category_id">
                        <option value="" disabled selected>Pilih salah satu</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->id; ?>" <?= old('category_id') == $category->id ? 'selected' : ''; ?>><?= $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($error && isset($errors['category_id'])) : ?>
                        <div class="text-danger">
                            <?= $errors['category_id']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="edit_author" class="form-label">Penulis</label>
                    <input type="text" class="form-control <?= $error && isset($errors['author']) ? 'is-invalid' : ''; ?>" id="edit_author" name="author" placeholder="Masukkan nama penulis" value="<?= old('author'); ?>">
                    <?php if ($error && isset($errors['author'])) : ?>
                        <div class="text-danger">
                            <?= $errors['author']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="edit_year" class="form-label">Tahun</label>
                    <input type="number" class="form-control <?= $error && isset($errors['year']) ? 'is-invalid' : ''; ?>" id="edit_year" name="year" placeholder="Masukkan tahun" value="<?= old('year'); ?>">
                    <?php if ($error && isset($errors['year'])) : ?>
                        <div class="text-danger">
                            <?= $errors['year']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn_edit_close_2" type="button" class="btn btn-secondary" style="width: 90px;" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" style="width: 90px;">Simpan</button>
            </div>
        </div>
    </div>
</form>

<form id="book_delete" action="<?= base_url('admin/book_delete'); ?>" method="post" class="modal" tabindex="-1">
    <input type="hidden" name="<?= csrf_token(); ?>" id="delete_csrf" value="<?= csrf_hash(); ?>">
    <input type="hidden" name="book_id" id="delete_book_id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td class="align-top" style="width: 100px;">Judul buku</td>
                        <td class="align-top"> : </td>
                        <td id="delete_book_title"></td>
                    </tr>
                    <tr>
                        <td class="align-top">Kategori</td>
                        <td class="align-top"> : </td>
                        <td id="delete_book_category"></td>
                    </tr>
                    <tr>
                        <td class="align-top">Penulis</td>
                        <td class="align-top"> : </td>
                        <td id="delete_book_author"></td>
                    </tr>
                    <tr>
                        <td class="align-top">Tahun</td>
                        <td class="align-top"> : </td>
                        <td id="delete_book_year"></td>
                    </tr>
                </table>
                <br>
                <p>Apakah Anda yakin ingin menghapus buku tersebut dari database?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="width: 90px;" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger" style="width: 90px;">Ya</button>
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
                $('#edit_csrf').val(data.csrf);
                $('#add_csrf').val(data.csrf);

                $('#edit_book_id').val(data.id);
                $('#edit_title').val(data.title);
                data.category_id ? $('#edit_category_id').val(data.category_id).change() : $('#edit_category_id').prop('selectedIndex', 0);
                $('#edit_author').val(data.author);
                $('#edit_year').val(data.year);
            },
        });
    });

    $('.btn-delete').click(function() {
        $('#delete_book_id').val($(this).data('book-id'));
        $('#delete_book_title').html($(this).data('book-title'));
        $('#delete_book_category').html($(this).data('book-category'));
        $('#delete_book_author').html($(this).data('book-author'));
        $('#delete_book_year').html($(this).data('book-year'));
    });

    $('input').change(function() {
        $(this).removeClass('is-invalid');
        $(this).siblings('.text-danger').hide();
    });
    $('select').change(function() {
        $(this).removeClass('is-invalid');
        $(this).siblings('.text-danger').hide();
    });

    $(function() {
        var modal_id = window.location.hash;
        history.pushState("", document.title, window.location.pathname + window.location.search);
        if (modal_id == '#book_edit') {
            $('#btn_edit_close_1').hide();
            $('#btn_edit_close_2').hide();
        }
        if (modal_id) $(modal_id).modal('show');

        $('.toast').toast('show');
    });
</script>

<?= $this->endSection('content'); ?>