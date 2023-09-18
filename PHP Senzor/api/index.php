<?php
require 'flight/Flight.php';
require '../Led/DAOLed.php';





Flight::route('GET /LedStatus/', function(){
	$dao = new DAOLed();
    $response = $dao->getStatusOnly();
    echo json_encode($response);
});



Flight::start();


?>