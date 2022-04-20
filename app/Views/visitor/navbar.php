<?php $seg = current_url(true)->getSegments(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-visitor" aria-controls="navbar-visitor" aria-expanded="false" aria-label="Buka bilah navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-visitor">
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                    <a href="/visitor" class="nav-link <?= $seg[1] == 'dashboard' ? 'active' : ''; ?>"><i class="bi bi-person"></i> Pengguna</a>
                </li>
                <li class="nav-item">
                    <a href="/visitor/borrow" class="nav-link <?= $seg[1] == 'borrow' ? 'active' : ''; ?>"><i class="bi bi-book"></i> Pinjam Buku</a>
                </li>
                <li class="nav-item">
                    <a href="/visitor/return" class="nav-link <?= $seg[1] == 'return' ? 'active' : ''; ?>"><i class="bi bi-book-fill"></i> Kembalikan Buku</a>
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