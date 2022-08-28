<?php
// include('authentication.php');
// include('includes/header.php');

$host   = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "db_smartpp_admin";

// Create database connection
$con = new mysqli($host, $dbuser, $dbpass, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$nodeSelect = $con->prepare("SELECT * FROM equipment_name");
$nodeSelect->execute();
$nodes = $nodeSelect->get_result();

$deviceSelect = $con->prepare("SELECT * FROM tc_node");
$deviceSelect->execute();
$devices = $deviceSelect->get_result();

$hardwareSelect = $con->prepare("SELECT * FROM equipment_hw");
$hardwareSelect->execute();
$hardwares = $hardwareSelect->get_result();


// To read ajax
$type = isset($_REQUEST['type']) && !empty($_REQUEST['type']) ? $_REQUEST['type'] : "";

if (!empty($type)) {
    
    if ($type == "get_models") {
 
        $node_id = isset($_REQUEST['node_id']) && !empty($_REQUEST['node_id']) ? $_REQUEST['node_id'] : "";
        $modelSelect = $con->prepare("SELECT * FROM equipment_model WHERE node_id = ?");
        $modelSelect->bind_param("i", $node_id);
        $modelSelect->execute();
        $models = $modelSelect->get_result();

        $itemRecords = array();
        while ($item = $models->fetch_assoc()) {
            extract($item);
            $itemDetails = array(
                "id" => $id,
                "name" => $name
            );
            array_push($itemRecords, $itemDetails);
        }

        echo json_encode(array(
            "status" => true,
            "data" => $itemRecords
        ));

        die;
    } 
    
}else{

}
