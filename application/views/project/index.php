<body>
    <div class="container mt-5">
        <h2 class="text-center mt-5 mb-3"><?php echo $title; ?></h2>
        <div class="card">
            <div class="card-header">
                <a class="btn btn-outline-primary" href="<?php echo base_url('project/create/'); ?>">
                    Create New Project
                </a>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>

                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date Created</th>
                        <th>Image</th>
                        <th width="240px">Action</th>
                    </tr>

                    <?php foreach ($projects as $project) { ?>
                        <tr>
                            <td><?php echo $project->name; ?></td>
                            <td><?php echo $project->description; ?></td>

                            <td><?php echo $project->created_at; ?></td>

                            <td>
                                
                                <?php
                                if ($project->image == null) {
                                    echo "No Image";
                                } else { ?>
                                    <img src="<?= base_url('../assets/project_images/') . $project->image ?>"
                                        alt="<?= $project->image ?>" class="rounded" height=70px width=70px>
                                <?php } ?>

                            </td>

                            <td>
                                <a class="btn btn-outline-info"
                                    href="<?php echo base_url('project/show/' . $project->id) ?>">
                                    Show
                                </a>
                                <a class="btn btn-outline-success"
                                    href="<?php echo base_url('project/edit/' . $project->id) ?>">
                                    Edit
                                </a>
                                <a class="btn btn-outline-danger" id="btndelete"
                                    href="<?php echo base_url('project/delete/' . $project->id) ?>">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteBtns = document.querySelectorAll('.btn-outline-danger'); // Select all delete buttons

        deleteBtns.forEach(function (deleteBtn) {
            deleteBtn.addEventListener('click', function (event) {
                // Ask confirmation before proceeding with deletion
                if (!confirm("Are you sure you want to delete this project?")) {
                    event.preventDefault(); // Prevent default form submission if user cancels
                }
            });
        });
    });
</script>