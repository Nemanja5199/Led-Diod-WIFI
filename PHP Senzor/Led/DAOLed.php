<?php

require_once '../config/db.php';

class DAOLed {

	private $db;

	private $GETSTATUS = "SELECT * FROM ledstatus WHERE id=1;";
	private $GETSTATUSONLY = "SELECT status FROM ledstatus WHERE id=1;";
	private $SETSTATUS = "UPDATE ledstatus SET status=? WHERE id=1;";
    

	public function __construct()
	{
		$this->db = DB::createInstance();
	}

	public function getStatus()
	{
		$statement = $this->db->prepare($this->GETSTATUS);
		 $statement->execute();

		$result=$statement->fetchAll();
		return $result;
	}


	public function getStatusOnly()
	{
		$statement = $this->db->prepare($this->GETSTATUSONLY);
		 $statement->execute();

		$result=$statement->fetchAll();
		return $result;
	}



	public function setStatus($status)
	{
		$statement = $this->db->prepare($this->SETSTATUS);

		$statement->bindValue(1,$status);

		return $statement->execute();

	}


}


?>