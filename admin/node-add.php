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
                    <h4>Add Node</h4>
                    <a href="node-view.php" class="btn btn-primary float-end">BACK</a>
                </div>
                <div class="card-body">

                    <form action="code.php" method="POST" enctype="multipart/form-data">

                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="node">Node MCU:</label>
                                <select id="node" name="node_id" class="form-control">
                                    <option value="" selected disabled>Select Node MCU</option>
                                    <?php foreach ($nodes as $key => $node) { ?>
                                        <option value="<?= $node['id'] ?>"> <?= $node['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="model">Model:</label>
                                <select name="mymodelname" id="model" value="name" class="form-control">

                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Node Name:</label>
                                <input type="text" name="node_name" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Node Location:</label>
                                <input type="text" name="node_location" class="form-control">
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" name="node_add" class="btn btn-primary">Save Node</button>
                            </div>


                        </div>

                    </form>

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