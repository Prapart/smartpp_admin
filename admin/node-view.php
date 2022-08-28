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
                    <h4>View Node</h4>
                    <a href="node-add.php" class="btn btn-primary float-end">Add Node</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>MCU ID Ref.</th>
                                    <th>Type ID Ref.</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <!-- <th>Status</th>
                                    <th>IP</th>
                                    <th>Mac</th> -->
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $nodeselect = "SELECT * FROM tc_node "; //WHERE node_status!='2' ";
                                $node_equ_model = "SELECT * FROM equipment_model "; //WHERE node_status!='2' ";
                                $node_equ_name = "SELECT * FROM equipment_name "; //WHERE node_status!='2' ";
                                
                                // $posts = "SELECT p.*, c.name AS cname FROM posts p, categories c WHERE c.id = p.category_id ";
                                // $nodes_equ = "SELECT  c.name AS cname  FROM tc_node p, equipment_name c WHERE c.id = p.node_id ";

                                $nodeselect_run = mysqli_query($con, $nodeselect);
                                $node_equ_model_run = mysqli_query($con, $node_equ_model);
                                $node_equ_name_run = mysqli_query($con, $node_equ_name);

                                if (mysqli_num_rows($nodeselect_run) > 0) {
                                    foreach ($nodeselect_run as $nodes) {
                                ?>
                                    <tr>
                                        <td><?= $nodes['id'] ?></td>
                                        <td><?= $nodes['node_name'] ?></td>

                                       <!-- <?
                                            if (mysqli_num_rows($node_equ_name_run) > 0) {
                                                $row = mysqli_fetch_array($node_equ_name_run);

                                                ?> <td><?= $row['name'] ?></td> <?
                                             
                                            }    
                                       ?> -->


                                        <td><?= $nodes['node_id'] ?></td>


                                        




                                        <td><?= $nodes['node_type'] ?></td>
                                        <td><?= $nodes['node_location'] ?></td>
                                        
                                        <!-- <td><img src="../uploads/posts/<?= $post['image'] ?>" width="60px" height="60px" /></td> -->


                                        <td>
                                            <?= $nodes['node_status'] == '1' ? 'Enabled' : 'Disabled' ?>
                                        </td>

                                        <td>
                                            <a href="node-edit.php?id=<?= $nodes['id'] ?>" class="btn btn-sm btn-outline-success py-0">Edit</a>
                                        </td>
                                        <td>
                                            <form action="code.php" method="POST">
                                                <button type="submit" name="node_delete_btn" value="<?= $nodes['id'] ?>" class="btn btn-sm btn-outline-danger py-0">Delete</button>
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