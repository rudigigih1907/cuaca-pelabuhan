<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cloud-sun-rain"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Cuaca Pelabuhan</div>
    </a>

    <hr class="sidebar-divider my-0">

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Profile
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/') ?>">
            <i class="fas fa-user"></i>
            <span>My Profile</span></a>
    </li>

    <?php if (userLogin()->role == 'Admin') : ?>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Admin Page
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesAdmin" aria-expanded="true" aria-controls="collapsePagesAdmin">
                <i class="fas fa-fw fa-users"></i>
                <span>User Management</span>
            </a>
            <div id="collapsePagesAdmin" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">User's</h6>
                    <a class="collapse-item" href="<?= base_url('admin') ?>">User's List</a>
                    <div class="collapse-divider"></div>
                </div>
            </div>
        </li>
    <?php endif ?>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Prakiraan Cuaca
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesPrakiraanCuaca" aria-expanded="true" aria-controls="collapsePagesPrakiraanCuaca">
            <i class="fas fa-cloud-sun-rain"></i>
            <span>Cuaca Pelabuhan</span>
        </a>
        <div id="collapsePagesPrakiraanCuaca" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cuaca Pelabuhan</h6>
                <a class="collapse-item" href="<?= base_url('/pelabuhan') ?>">Daftar Pelabuhan</a>
                <a class="collapse-item" href="<?= base_url('/cuaca') ?>">Data Cuaca</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('logout') ?>">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <hr class="sidebar-divider">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>