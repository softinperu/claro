<?php

$miembros = array();
$etiquetas = array();
$data = array();
$lists = array();

$url = "../../../cargar/archivo_trello/u1f2zQ2B.json";
$json = file_get_contents($url);
$obj = json_decode($json, true);


/* MIEMBROS DEL TRELLO */
for ($i = 0; $i < count($obj["members"]); $i++) {
    $miembros[$i][0] = $obj["members"][$i]["id"];
    $miembros[$i][1] = $obj["members"][$i]["fullName"];
}
/* ETIQUETAS */
for ($i = 0; $i < count($obj["labels"]); $i++) {
    $etiquetas[$i][0] = $obj["labels"][$i]["id"];
    $etiquetas[$i][1] = $obj["labels"][$i]["name"];
}
/* LISTAS DEL TRELLO */
for ($i = 0; $i < count($obj["lists"]); $i++) {
    $lists[$i][0] = $obj["lists"][$i]["id"];
    $lists[$i][1] = $obj["lists"][$i]["name"];
}


/* DATA CARDS */

for ($i = 0; $i < count($obj["cards"]); $i++) {
    /* id del card */
    $data[$i][0] = $obj["cards"][$i]["id"];

    /* miembros del equipo ARRAY */
    if (count($obj["cards"][$i]["idMembers"]) > 0) {
        for ($a = 0; $a < count($obj["cards"][$i]["idMembers"]); $a++) {
            for ($b = 0; $b < count($obj["members"]); $b++) {
                if ($obj["cards"][$i]["idMembers"][$a] === $miembros[$b][0]) {
                    $data[$i][1][$a] = $miembros[$b][1];
                }
            }
        }
    } else {
        $data[$i][1][0] = "No asignado";
    }



    /*     * *************** etiquetas ****************** */
    /*     * ******************************************** */
//flags 
    $f_etapa = 0;
    $f_grupo = 0;
    $f_gerencia = 0;
    $f_dependencia = 0;
    $f_subdependencia = 0;
    $f_tipo = 0;

    if (count($obj["cards"][$i]["labels"]) > 0) {
        for ($c = 0; $c < count($obj["cards"][$i]["labels"]); $c++) {
            $etiquetas_card[$i][$c][0] = $obj["cards"][$i]["labels"][$c]["name"];
            $etiquetas_card[$i][$c][1] = $obj["cards"][$i]["labels"][$c]["color"];
        }
    } else {
        $etiquetas_card[$i][0][0] = "";
        $etiquetas_card[$i][0][1] = "";
    }
    /* tipo */
    for ($d = 0; $d < count($etiquetas_card[$i]); $d++) {

        if ($etiquetas_card[$i][$d][1] === "green") {
            $f_tipo = 1;
            $data[$i][2] = $etiquetas_card[$i][$d][0];
        }
        if ($f_tipo === 0) {
            $data[$i][2] = "Sin Tipo";
        }
    }
    /* grupo */
    for ($d = 0; $d < count($etiquetas_card[$i]); $d++) {
        if ($etiquetas_card[$i][$d][1] === "blue") {
            $data[$i][3] = $etiquetas_card[$i][$d][0];
            $f_grupo = 1;
        }
        if ($f_grupo === 0) {
            $data[$i][3] = "Sin Grupo";
        }
    }
    /* gerencia y responsable */
    for ($d = 0; $d < count($etiquetas_card[$i]); $d++) {

        if ($etiquetas_card[$i][$d][1] === "orange") {

            $data[$i][4] = $etiquetas_card[$i][$d][0];
            switch ($data[$i][4]) {
                case "GER: ARQUITECTURA":
                    $responsable = "Wilmer Escudero";
                    break;
                case "GER: AUTO ASISTIDO":
                    $responsable = "Edison Ramirez";
                    break;
                case "GER: BI":
                    $responsable = "Luis Palacios";
                    break;
                case "GER: ADMINISTRATIVO":
                    $responsable = "Juvel Palacios";
                    break;
                case "GER: OPERACIONAL":
                    $responsable = "Carlos Rey";
                    break;
                case "GER: POSTVENTA":
                    $responsable = "Franklin Barrios";
                    break;
                case "GER: TARIFICACION":
                    $responsable = "Wilson Ibarra";
                    break;
                case "GER: VENTA":
                    $responsable = "Wilson Ibarra";
                    break;
            }
            $data[$i][5] = $responsable;
            $f_gerencia = 1;
        }
        if ($f_gerencia === 0) {
            $data[$i][4] = "Sin Gerencia";
            $data[$i][5] = "Sin Responsable";
        }
    }

    /* etapa */
    for ($d = 0; $d < count($etiquetas_card[$i]); $d++) {
        if ($etiquetas_card[$i][$d][1] === "yellow") {
            $data[$i][6] = $etiquetas_card[$i][$d][0];
            $f_etapa = 1;
        }
        if ($f_etapa === 0) {
            $data[$i][6] = "Sin Etapa";
        }
    }

    /* Dependencia */
    for ($d = 0; $d < count($etiquetas_card[$i]); $d++) {
        if ($etiquetas_card[$i][$d][1] === "red") {
            $data[$i][7] = $etiquetas_card[$i][$d][0];
            $f_dependencia = 1;
        }
        if ($f_dependencia === 0) {
            $data[$i][7] = "Sin Dependencia";
        }
    }

    /* Sub Dependencia */
    for ($d = 0; $d < count($etiquetas_card[$i]); $d++) {
        if ($etiquetas_card[$i][$d][1] === "purple") {
            $data[$i][8] = $etiquetas_card[$i][$d][0];
            $f_subdependencia = 1;
        }
        if ($f_subdependencia === 0) {
            $data[$i][8] = "";
        }
    }
    /*     * ************************************************************** */

    /* lista de pertenencia */
    for ($d = 0; $d < count($obj["lists"]); $d++) {
        if ($obj["cards"][$i]["idList"] === $lists[$d][0]) {
            $data[$i][9] = $lists[$d][1];
        }
    }

    /* nombre principal de la card */
    $data[$i][10] = $obj["cards"][$i]["name"];

    /* Fecha de vencimiento */
    $fecha = $obj["cards"][$i]["due"];
    $fecha_venc = explode("T", $fecha);
    if ($obj["cards"][$i]["due"] === null) {
        $data[$i][11] = "";
    } else {
        $data[$i][11] = date("d/m/y", strtotime($fecha_venc[0]));
    }

    /* fecha inicio,fin real */
    $descripcion = $obj["cards"][$i]["desc"];
    if ($descripcion !== "") {
        $descripcion_1 = explode("\n", $descripcion);
        $fecha_inicial = explode(":", $descripcion_1[0]);
        $data[$i][12] = $fecha_inicial[1];
        /* fecha de fin real */
        $fecha_final = explode(":", $descripcion_1[1]);
        $data[$i][13] = $fecha_final[1];
    } else {
        $data[$i][12] = "";
        $data[$i][13] = "";
    }
}


$output = array('data' => array());
$i = 0;

while ($i < count($obj["cards"])) {

    for ($z = 0 ; $z< count($data[$i][1]) ;$z++) {
        $output['data'][] = array(
            // Arquitecto 
            $data[$i][1][$z],
            //NombreCard - actividad
            $data[$i][10],
            // tipo
            $data[$i][2],
            //grupo
            $data[$i][3],
            //gerencia
            $data[$i][4],
            //responsable
            $data[$i][5],
            //etapa
            $data[$i][6],
            //Lista de pertenencia
            $data[$i][9],
            //responsable dependencia
            $data[$i][7],
            //SubDependencia
            $data[$i][8],
            //fecha vencimiento
            $data[$i][11],
            //fecha inicio real
            $data[$i][12],
            //fecha fin real
            $data[$i][13]
        );
    }

    $i++;
}
echo json_encode($output);


