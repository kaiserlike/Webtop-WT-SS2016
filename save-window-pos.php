<?php 
	include 'common.inc.php';
	$posX = $_POST["x"];
	$posY = $_POST["y"];
	$id = $_POST["id"];

	if(!isset($_SESSION["iconPos"])) $_SESSION["iconPos"] = array();
	if(!isset($_SESSION["windowPos"])) $_SESSION["windowPos"] = array();

	// check if window or icon got dragged
	if(strpos($id, 'icon') !== false){
		//get id of dragged item as number
		$id = substr($id, strpos($id, "-") + 1);
		$_SESSION["iconPos"][$id] = array($posX,$posY);

	} else {
		$id = substr($id, strpos($id, "-") + 1);
		$_SESSION["windowPos"][$id] = array($posX,$posY);
	}
 ?>