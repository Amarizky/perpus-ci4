<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<?php $alert = session()->getFlashdata('alert'); ?>
<?php $error = session()->getFlashdata('errorFor') == 'login'; ?>
<?php $errors = session()->getFlashdata('errors'); ?>

<div class="container-fluid h-100">
    <div class="row align-items-center h-100">
        <div class="col-sm-2 col-md-4"></div>
        <div class="col-sm-8 col-md-4">
            <!-- <div class="card" style="margin-top: 150px;"> -->
            <div id="login-card" class="card carousel slide border-primary">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <button id="btn-pengunjung" type="button" class="nav-link <?= $alert ? '' : 'active'; ?>" data-bs-target="#login-card" data-bs-slide-to="0" aria-current="true" href="#pengunjung">Pengunjung</button>
                        </li>
                        <li class="nav-item">
                            <button id="btn-admin" type="button" class="nav-link <?= $alert ? 'active' : ''; ?>" data-bs-target="#login-card" data-bs-slide-to="1" aria-current="true" href="#admin">Admin</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body carousel-inner">
                    <div class="carousel-item <?= $alert ? '' : 'active'; ?>">
                        <form method="post" action="<?= base_url('login/visitor'); ?>">
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control <?= $error && isset($errors['name']) ? 'is-invalid' : ''; ?>" list="names" name="name" placeholder="Masukkan namamu" value="<?= old('name'); ?>">
                                <?php if ($error && isset($errors['name'])) : ?>
                                    <div class="text-danger">
                                        <?= $errors['name']; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($names) : ?>
                                    <datalist id="names">
                                        <?php foreach ($names as $n) : ?>
                                            <option value="<?= $n->name; ?>"><?= $n->name; ?></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="classroom" class="form-label">Kelas</label>
                                <input type="text" class="form-control <?= $error && isset($errors['classroom']) ? 'is-invalid' : ''; ?>" list="classrooms" name="classroom" placeholder="Masukkan kelasmu" value="<?= old('classroom'); ?>">
                                <?php if ($error && isset($errors['classroom'])) : ?>
                                    <div class="text-danger">
                                        <?= $errors['classroom']; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($classrooms) : ?>
                                    <datalist id="classrooms">
                                        <?php foreach ($classrooms as $c) : ?>
                                            <option value="<?= $c->classroom; ?>"><?= $c->classroom; ?></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                <?php endif; ?>
                            </div>
                            <div class="w-100 text-end">
                                <button type="submit" class="btn btn-primary">Masuk</button>
                            </div>
                        </form>
                    </div>
                    <div class="carousel-item <?= $alert ? 'active' : ''; ?>">
                        <?php if ($alert) : ?>
                            <div class="alert alert-<?= $alert['status']; ?>" role="alert">
                                <?= $alert['message']; ?>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="<?= base_url('login/admin'); ?>">
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label for="username" class="form-label">Nama pengguna</label>
                                <input type="text" class="form-control" name="username" placeholder="Masukkan nama pengguna" value="<?= old('username'); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Kata sandi</label>
                                <input type="password" class="form-control" name="password" placeholder="Masukkan kata sandi" <?= old('username') ? 'autofocus' : ''; ?>>
                            </div>
                            <div class="w-100 text-end">
                                <button type="submit" class="btn btn-primary">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2 col-md-4"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var navLinks = $('.nav-link');
        navLinks.each(function(i, e) {
            $(e).click(function() {
                $('.nav-link').each((i, e) => $(e).removeClass('active'));
                $(this).addClass('active');
            })
        });

        var baseUrl = window.location.href;
        var hash = baseUrl.lastIndexOf('#');
        if (hash != -1) {
            var elId = baseUrl.substring(hash + 1);
            $('#btn-' + elId).click();
        }
    });
</script>

<?= $this->endSection('content'); ?>