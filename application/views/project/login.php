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
                <h2 class="text-center fw-bold">Login</h2>
            </div>
            <div class="card-body">
                <form action ="<?= base_url('login_user') ?>" method="post">
                    <div class="input-group mb-3">
                        <label for="username" class="input-group-text">Username:</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="">
                    </div>
                    <div class="input-group mb-3">
                        <label for="username" class="input-group-text">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary px-3" type="submit">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="text-center"><h6>No account yet? <a href="<?= base_url('register') ?>" class="text-primary text-decoration-none">Register</a></h6></div>
            </div>
        </div>
    </div>
</body>