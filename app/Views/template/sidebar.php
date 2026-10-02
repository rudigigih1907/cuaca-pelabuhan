<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Menu</div>
                <a class="nav-link" href="<?= base_url('/ports') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Pelabuhan
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <div class="fw-bold"><?= userLogin()?->username ?></div>
            <div class="mt-2">
                <a class="text-warning text-decoration-none small" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </a>
            </div>
        </div>
    </nav>
</div>