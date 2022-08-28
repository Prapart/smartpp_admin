<?php
include('authentication.php');
include('includes/header.php');
?>
<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">

            <?php include('message.php'); ?>

            <div class="card">
                <div class="card-header">
                    <h4>View Device</h4>
                    <a href="device-add.php" class="btn btn-primary float-end">Add Device</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Device Name</th>
                                    <th>Device Type</th>
                                    <th>Port I/O</th>
                                    <th>Status</th>
                                    <th>Location</th>
                                    <th>Node ID</th>
                                    <th>Node PIN</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $deviceselect = "SELECT * FROM tc_device "; //WHERE node_status!='2' ";
                                // $posts = "SELECT p.*, c.name AS cname FROM posts p, categories c WHERE c.id = p.category_id ";

                                $deviceselect_run = mysqli_query($con, $deviceselect);

                                if (mysqli_num_rows($deviceselect_run) > 0) {
                                    foreach ($deviceselect_run as $devices) {
                                ?>
                                        <tr>
                                            <td><?= $devices['id'] ?></td>
                                            <td><?= $devices['device_name'] ?></td>
                                            <td><?= $devices['device_type'] ?></td>
                                            <td><?= $devices['device_io'] ==  '1' ? 'Input' : 'Output' ?></td> 
                                            <td><?= $devices['device_status'] == 0 ? 'Disabled' : 'Enabled' ?></td> 
                                            <td><?= $devices['device_location'] ?></td>
                                            <td><?= $devices['node_id'] ?></td> 
                                            <td><?= $devices['node_pin'] ?></td> 
                                           
                                            <td>
                                                <a href="device-edit.php?id=<?= $devices['id'] ?>" class="btn btn-sm btn-outline-primary py-0">Edit</a>
                                            </td>
                                            <td>
                                                <form action="code.php" method="POST">
                                                    <button type="submit" id="alert" name="device_delete_btn" value="<?= $devices['id'] ?>" class="btn btn-sm btn-outline-danger py-0">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php

                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6">No Record Found</td>
                                    </tr>
                                <?php
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php


    include('includes/footer.php');
    include('includes/scripts.php');
    ?>
