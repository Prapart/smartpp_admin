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
                    <h4>Add Device</h4>
                    <a href="device-view.php" class="btn btn-primary float-end">BACK</a>
                </div>
                <div class="card-body">

                    <form action="code.php" method="POST" enctype="multipart/form-data">

                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="node">Select Node Name:</label>
                                <select id="node_id" name="node_id" class="form-control">
                                    <option value="" selected disabled>--Select Node MCU--</option>
                                    <?php foreach ($devices as $key => $device) { ?>
                                        <option value="<?= $device['id'] ?>"> <?= $device['node_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="form-group col-md-6 mb-3">
                                <label for="model">Use Node Pin:</label>
                                <select id="node_pin" name="node_pin" class="form-select" aria-label="Default select example">
                                        <option selected disabled>--Select Pin--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        </select>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="device_type">Select Device:</label>
                                <select id="device_type" name="device_type" class="form-control">
                                    <option value="" selected disabled>--Select device--</option>
                                    <?php foreach ($hardwares as $key => $hardware) { ?>
                                        <option value="<?= $hardware['name'] ?>"> <?= $hardware['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="form-group col-md-6 mb-3">

                                <label for="model">input/Output:</label>
                                <select id="device_io" name="device_io"  class="form-select" aria-label="Default select example">
                                        <option selected disabled>--Select type--</option>
                                        <option value="1">Input</option>
                                        <option value="2">Output</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Device Name:</label>
                                <input type="text" name="device_name" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Device Location:</label>
                                <input type="text" name="device_location" class="form-control">
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" name="device_add" class="btn btn-primary">Add Device</button>
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