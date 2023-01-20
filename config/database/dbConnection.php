<?php 

//Local MySQL config
$dbName = 'Salesforce';
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';

try{
    $db = new PDO("mysql:dbname=" . $dbName . ";host=" . $dbHost, $dbUser, $dbPassword);
}

catch(PDOException $e){
    header('Content-Type:application/json');
    http_response_code(500);

    $return = [
        'ERROR' => 'LOCAL DATABASE CONNECTION ERROR',
        'MSG' => $e->getMessage()
    ];

    echo json_encode($return);
    exit;
}
