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
                    <h4>Edit Device</h4>
                    <a href="device-view.php" class="btn btn-primary float-end">BACK</a>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $device_query = "SELECT * FROM tc_device WHERE id='$id' LIMIT 1";
                        $device_query_res = mysqli_query($con, $device_query);

                        if (mysqli_num_rows($device_query_res) > 0) {
                            $device_row = mysqli_fetch_array($device_query_res);
                    ?>
                            <form action="code.php" id="myForm" method="POST" enctype="multipart/form-data">
                                <div class="row">

                                    <input type="hidden" name="id" value="<?= $device_row['id'] ?>" class="form-control">

                                    <div class="col-md-6 mb-3">
                                        <label for="">Device Name</label>
                                        <input type="text" name="device_name" value="<?= $device_row['device_name'] ?>" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="device_type">Select Device:</label>
                                        <select id="device_type" name="device_type" class="form-control">
                                            <option selected='selected' value="<?= $device_row['device_type'] ?>" selected='selected'><?= $device_row['device_type'] ?></option>
                                            <?php foreach ($hardwares as $key => $hardware) { ?> 
                                                <option value="<?= $hardware['name'] ?>"> <?= $hardware['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="">input/Output:</label>
                                        <select id="device_io" name="device_io" class="form-select" aria-label="Default select example">
                                            <option selected='selected' value="<?= $device_row['device_io'] ?>" selected='selected'><?= $device_row['device_io'] == 1 ? 'Input':'Output' ?></option>
                                            <option value=1>Input</option>
                                            <option value=2>Output</option>

                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Device Status</label>
                                        <select id="device_status" name="device_status" class="form-select" aria-label="Default select example">
                                            <option selected='selected' value="<?= $device_row['device_status'] ?>" selected='selected'><?= $device_row['device_status'] == 1 ? 'Enabled':'Disabled' ?></option>
                                            <option value=0>Disabled</option>
                                            <option value=1>Enabled</option>

                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Device Location</label>
                                        <input type="text" name="device_location" value="<?= $device_row['device_location'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Node ID</label>
                                        <input type="text" name="node_id" value="<?= $device_row['node_id'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Node PIN</label>
                                        <input type="text" name="node_pin" value="<?= $device_row['node_pin'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Node ..</label>
                                        <input type="text" name="node_pi" value="<?= $device_row['node_pin'] ?>" class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <input type="hidden" name="device_update" value="true" class="form-control">
                                        <button type="button" onclick="myFuntion()"  class="btn btn-primary">Update Device</button>
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

    <script>

            function myFuntion(){


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                    document.getElementById("myForm").submit();
                }
                })
            }

    </script>

    <script src="assets/jquery.min.js"></script>
    <script type=text/javascript src="scripts-addnode.js"></script>

    <?php
    include('includes/footer.php');
    include('includes/scripts.php');
    ?>