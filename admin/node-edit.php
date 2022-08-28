<?php
include('authentication.php');
include('includes/header.php');
require 'functions.php';
?>

<div class="container-fluid px-4">

    <div class="row mt-4">
        <div class="col-md-12">

            <?php include('message.php'); ?>

            <div class="card">
                <div class="card-header">
                    <h4>Edit Node</h4>
                    <a href="node-view.php" class="btn btn-primary float-end">BACK</a>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $node_query = "SELECT * FROM tc_node WHERE id='$id' LIMIT 1";
                        $node_query_res = mysqli_query($con, $node_query);

                        if (mysqli_num_rows($node_query_res) > 0) {
                            $node_row = mysqli_fetch_array($node_query_res);
                    ?>

                            <form action="code.php" method="POST" enctype="multipart/form-data">



                                <div class="row">

                                   
                                        <!-- <label for="">ID</label> -->
                                        <input type="hidden"  name="id" value="<?= $node_row['id'] ?>" class="form-control">
                                  

                                    <div class="col-md-6 mb-3">
                                        <label for="">Node Name</label>
                                        <input type="text" name="node_name" value="<?= $node_row['node_name'] ?>" class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Node ID</label>
                                        <input type="text" name="node_id" value="<?= $node_row['node_id'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Node Type</label>
                                        <input type="text" name="node_type" value="<?= $node_row['node_type'] ?>" max="191" requered class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Node Location</label>
                                        <input type="text" name="node_location" value="<?= $node_row['node_location'] ?>" max="191" requered class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <button type="submit" name="node_update" class="btn btn-primary">Update Node</button>
                                    </div>
                                </div>
                            </form>
                        <?php
                        } else {
                        ?>
                            <h4>No Record Found </h4>
                    <?php
                        }
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>

    <script src="assets/jquery.min.js"></script>
    <script type=text/javascript src="scripts-addnode.js"></script>

    <?php
    include('includes/footer.php');
    include('includes/scripts.php');
    ?>