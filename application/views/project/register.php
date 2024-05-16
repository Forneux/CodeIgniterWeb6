<body>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <div class="container mt-5">
        <div class="card w-50 mx-auto my-auto">
            <div class="card-header">
                <h2 class="text-center fw-bold">Register</h2>
            </div>
            <div class="card-body">
                <form action="<?= base_url('register_user') ?>" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <label for="fname" class="input-group-text fw-bold">First Name:</label>
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="">
                    </div>
                    <div class="input-group mb-3">
                        <label for="lname" class="input-group-text fw-bold">Last Name:</label>
                        <input type="text" class="form-control" name="lname" id="lname" placeholder="">
                    </div>

                    <div class="input-group mb-3">
                        <label for="username" class="input-group-text fw-bold">Username:</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="">
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="input-group-text fw-bold">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="">
                    </div>
                    <div class="input-group mb-3">
                        <label for="" class="input-group-text fw-bold">Picture:</label>
                        <input type="file" class="form-control" name="pic" id="pic">
                    </div>  

                    <div class="text-center">
                        <button class="btn btn-success px-3" type="submit">Register</button>
                        <div class="text-center fw-bold">
                            Already have an account? <a href="<?=base_url('../')?>" class="text-primary text-decoration-none">Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>