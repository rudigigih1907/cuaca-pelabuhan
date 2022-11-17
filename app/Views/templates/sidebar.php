<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cloud-sun-rain"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Weather</div>
    </a>

    <!-- Divider Dashboard -->
    <hr class="sidebar-divider my-0">

    <!-- Divider Profile-->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Profile
    </div>
    <!-- Nav Item - My Profile -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/') ?>">
            <i class="fas fa-user"></i>
            <span>My Profile</span></a>
    </li>

    <?php if (userLogin()->role == 'Admin') : ?>
        <!-- Divider Admin Page -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Page
        </div>
        <!-- Nav Item - Pages Collapse Menu User's Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesAdmin" aria-expanded="true" aria-controls="collapsePagesAdmin">
                <i class="fas fa-fw fa-users"></i>
                <span>User Management</span>
            </a>
            <div id="collapsePagesAdmin" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">User's</h6>
                    <a class="collapse-item" href="<?= base_url('admin') ?>">User's List</a>
                    <a class="collapse-item" href="#">Group</a>
                    <a class="collapse-item" href="#">Role</a>
                    <div class="collapse-divider"></div>
                </div>
            </div>
        </li>
    <?php endif ?>

    <!-- Divider prakiraan Cuaca -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Prakiraan Cuaca
    </div>
    <!-- Nav Item - Pages Collapse Menu Prakiraan -->
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
                <a class="collapse-item" href="<?= base_url('/berkas') ?>">Documents</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

    <!-- Divider Logout -->
    <hr class="sidebar-divider">

    <!-- Nav Item - User Logout -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('logout') ?>">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>