<?php
require_once 'ControllerLed.php';
$action=isset($_REQUEST['action'])?$_REQUEST['action']:"";


$led_status= isset($_POST['led_status']) ? $_POST['led_status'] : '0';



switch($_SERVER['REQUEST_METHOD']){

    
    case "GET":
        switch ($action) {
            case 'Pocetna':
                $cs = new ControllerLed();
                $status = $cs->GetStatus();
                include_once '../view/pocetna.php';
                break;
                
                
        }
        break;

    case "POST":
        switch ($action) {
            case 'Toggle':
                $cs = new ControllerLed();
                $cs->SetStatus($led_status);
                header('Location: ../?action=Pocetna');
                break;
        }
        break;


}








?>
