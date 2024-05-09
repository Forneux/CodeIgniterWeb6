<?php
if (!isset($_SESSION['User_ID'])) {// !$this->session->userdata('User_ID')
    $this->session->set_flashdata('error', 'Please log in first.');
    redirect(base_url());
    exit();
}
?>

<header class="sticky-top" style="background-color: #fd7e14;">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            
            <a class="navbar-brand" href="<?php echo base_url('home'); ?>">Ci3 Project Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('project'); ?>">All Projects</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url('../assets/profimg/') . $_SESSION['Profile_Pic']; ?>" class="profile-pic"
                                height=30px width=30px style="border-radius:50%;">
                            Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow"
                            aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('logout'); ?>">
                                    <i class="bi bi-box-arrow-right"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</header>