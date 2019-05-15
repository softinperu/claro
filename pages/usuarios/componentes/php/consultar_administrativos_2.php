<?php

require '../../../../conexionbd/connectDB.php';

$sql = "SELECT * from login l join roles_usuarios r on r.ID = l.rol where l.rol BETWEEN 1 and 6";

$result = DBi::$mysqli->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {

    while ($row = $result->fetch_array()) {
        $myDate3 = new DateTime($row[7]);
        $formatFI3 = $myDate3->format('d/m/Y');
        if ($row[5] == 1) {
            $estado = '<span class="label label-success">Activo</span>';
        } else {
            $estado = '<span class="label label-danger">Bloqueado</span>';
        }

        $output['data'][] = array(
            // nombres2		
            $row[1],
            //apell	3
            $row[2],
            //dni 4
            $row[8],
            //email	5	
            $row[3],
            // situacion 6
            $estado,
            //rol del join
            $row[15],
            //fecha_registro 8
            $formatFI3
        );
    } // /while 
}// if num_rows

DBi::$mysqli->close();

echo json_encode($output);

