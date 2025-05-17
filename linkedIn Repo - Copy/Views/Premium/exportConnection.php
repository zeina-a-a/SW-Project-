<?php

require_once '../../Controllers/ConnectionController.php';
require_once '../../Models/Connection.php';
require_once '../shared/sessionControl.php';


//if($_SERVER['REQUEST_METHOD']==='POST'){
$controller = new ConnectionController();
$connections = $controller->getUserConnections($userId);

if (!empty($connections)) {

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=connections.csv');

    $output = fopen("php://output", "w");
    fputcsv($output, ['ConnectionId','UserName', 'Email']); // Header row

    foreach ($connections as $conn) {
        fputcsv($output, [$conn['connectionId'], $conn['username'], $conn['email']]);
    }

    fclose($output);
    exit;
} else {
    echo "No connections found.";
}
//}
?>