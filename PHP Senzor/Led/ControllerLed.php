<?php

require_once 'DAOLed.php';


class ControllerLed{

    function GetStatus()
    {
        $dao = new DAOLed();
        $Ledstatus = $dao->getStatus();
        return $Ledstatus;
    }


    function SetStatus($status)
    {
        $dao = new DAOLed();
         $dao->setStatus($status);
       
    }


   
}
?>