<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<?= $this->include('visitor/navbar'); ?>

<?php helper('date'); ?>

<div class="container-fluid">
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
    <div class="row mb-4">
        <div class="col">
            <div class="row mb-2">
                <div class="col">
                    <h4>Buku yang sedang dipinjam</h4>
                </div>
                <div class="col text-end">
                    <a href="<?= base_url('/visitor/return'); ?>" style="width: 170px;" class="btn btn-success"><i class="bi bi-book-fill"></i> Kembalikan Buku</a>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 4%;" class="text-center">#</th>
                        <th scope="col" style="width: 30%;">Judul Buku</th>
                        <th scope="col" style="width: 10%;">Kategori</th>
                        <th scope="col" style="width: 18%;">Penulis</th>
                        <th scope="col" style="width: 10%;" class="text-center">Tahun Terbit</th>
                        <th scope="col" style="width: 15%;" class="text-center">Tanggal Pinjam</th>
                        <th scope="col" style="width: 15%;" class="text-center">Harus Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = (($page - 1) * 20) + 1; ?>
                    <?php if (!$borrowedBookList) : ?>
                        <tr>
                            <td class="text-center" colspan="7">Belum ada buku yang dipinjam</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($borrowedBookList as $b) : ?>
                        <tr style="height: 66px;" class="<?= now() > $b->returns_in ? 'bg-warning' : ''; ?>">
                            <td class="align-middle text-center"><?= $i++; ?></td>
                            <td class="align-middle"><?= $b->title; ?></td>
                            <td class="align-middle"><?= $b->category; ?></td>
                            <td class="align-middle"><?= $b->author; ?></td>
                            <td class="align-middle text-center"><?= $b->year; ?></td>
                            <td class="align-middle text-center"><?= $b->loaned_at ? 'Jam ' . str_replace(' ', "<br>", unixToHumanFull($b->loaned_at)) : '-'; ?></td>
                            <td class="align-middle text-center"><?= $b->returns_in ? unixToHumanDate($b->returns_in) : '-'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="row mb-2">
                <div class="col">
                    <h4>Buku yang pernah dipinjam</h4>
                </div>
                <div class="col text-end">
                    <a href="<?= base_url('/visitor/borrow'); ?>" style="width: 170px;" class="btn btn-primary"><i class="bi bi-book"></i> Pinjam Buku</a>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 4%;" class="text-center">#</th>
                        <th scope="col" style="width: 30%;">Judul Buku</th>
                        <th scope="col" style="width: 10%;">Kategori</th>
                        <th scope="col" style="width: 18%;">Penulis</th>
                        <th scope="col" style="width: 10%;" class="text-center">Tahun Terbit</th>
                        <th scope="col" style="width: 15%;" class="text-center">Tanggal Pinjam</th>
                        <th scope="col" style="width: 15%;" class="text-center">Dikembalikan Pada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = (($page - 1) * 20) + 1; ?>
                    <?php if (!$recentBookList) : ?>
                        <tr>
                            <td class="text-center" colspan="9">Belum ada buku yang pernah dipinjam</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($recentBookList as $b) : ?>
                        <tr style="height: 66px;">
                            <td class="align-middle text-center"><?= $i++; ?></td>
                            <td class="align-middle"><?= $b->title; ?></td>
                            <td class="align-middle"><?= $b->category; ?></td>
                            <td class="align-middle"><?= $b->author; ?></td>
                            <td class="align-middle text-center"><?= $b->year; ?></td>
                            <td class="align-middle text-center"><?= 'Jam ' . str_replace(' ', "<br>", unixToHumanFull($b->loaned_at)); ?></td>
                            <td class="align-middle text-center"><?= 'Jam ' . str_replace(' ', "<br>", unixToHumanFull($b->returns_at)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>