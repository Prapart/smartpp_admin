<?php
session_start();
include('authentication.php');
include('includes/header.php');
?>
<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">

            <?php include('message.php');

            $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
            $txt = "John23333 Doe\n";
            fwrite($myfile, $txt);
            $txt = "Jane Doe\n";
            fwrite($myfile, $txt);
            fclose($myfile);

            $_SESSION['message'] = "Create file done.!";

            ?>
        </div>
    </div>
    <?php


    include('includes/footer.php');
    include('includes/scripts.php');
    ?>