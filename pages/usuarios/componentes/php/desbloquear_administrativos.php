<?php 	

require '../../../../conexionbd/connectDB.php';



$valid['success'] = array('success' => false, 'messages' => array());

$userId = $_POST['userId'];

if($userId) { 

 
 $sql = "UPDATE login SET Situacion = 1 WHERE id='$userId'";


 if(DBi::$mysqli->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Desbloqueado exitosamente";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error no se ha podido desbloquear";
 }
 
 DBi::$mysqli->close();

 echo json_encode($valid);
 
} // /if $_POST