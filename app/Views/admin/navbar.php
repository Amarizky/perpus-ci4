<?php $seg = current_url(true)->getSegments(); ?>
<!-- TODO: Rename navbar-admin to admin/navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-admin" aria-controls="navbar-admin" aria-expanded="false" aria-label="Buka bilah navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-admin">
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                    <a href="/admin" class="nav-link <?= $seg[0] == 'admin' && !isset($seg[1]) ? 'active' : ''; ?>"><i class="bi bi-book"></i> Buku</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/categories" class="nav-link <?= isset($seg[1]) && $seg[1] == 'categories' ? 'active' : ''; ?>"><i class="bi bi-tags"></i> Kategori</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/visitors" class="nav-link <?= isset($seg[1]) && $seg[1] == 'visitors' ? 'active' : ''; ?>"><i class="bi bi-people"></i> Pengunjung</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="/logout" class="nav-link">Keluar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>