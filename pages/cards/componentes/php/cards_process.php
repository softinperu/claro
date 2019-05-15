<?php

$miembros = array();
$etiquetas = array();
$data = array();
$lists = array();

$url = "../../../../includes/iL4mMbep.json";
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

    /* nombre principal de la card */
    $data[$i][1] = $obj["cards"][$i]["name"];

    /* fecha vencimiento */
    $fecha_ven = explode("T", $obj["cards"][0]["due"]);
    $data[$i][2] = date("d/m/y", strtotime($fecha_ven[0]));

    /* miembros del equipo */
    if (count($obj["cards"][$i]["idMembers"]) > 0) {
        for ($a = 0; $a < count($obj["cards"][$i]["idMembers"]); $a++) {
            for ($b = 0; $b < count($obj["members"]); $b++) {
                if ($obj["cards"][$i]["idMembers"][$a] === $miembros[$b][0]) {
                    $data[$i][3][$a] = $miembros[$b][1];
                }
            }
        }
    } else {
        $data[$i][3][0] = "No asignado";
    }

    /* etiqueta */
    if (count($obj["cards"][$i]["labels"]) > 0) {
        for ($c = 0; $c < count($obj["cards"][$i]["labels"]); $c++) {
            $data[$i][4][$c] = $obj["cards"][$i]["labels"][$c]["name"];
        }
    } else {
        $data[$i][4][0] = "Sin etiqueta";
    }

    /* lista de pertenencia */
    for ($d = 0; $d < count($obj["lists"]); $d++) {
        if ($obj["cards"][$i]["idList"] === $lists[$d][0]) {
            $data[$i][5] = $lists[$d][1];
        }
    }
}

$output = array('data' => array());
$i = 0;
$button = '<button type="button" class="btn btn-danger">Ver</button>';
while ($i < count($obj["cards"])) {
    for ($a = 0; $a < count($data[$i][3]); $a++) {
        for ($b = 0; $b < count($data[$i][4]); $b++) {
            switch ($data[$i][4][$b]) {
                case "Dependencia Fábrica":
                    $dependencia = "Dependencia Fábrica";
                    break;
                case "Dependencia Legados":
                    $dependencia = "Dependencia Legados";
                    break;
                case "Dependencia ONE":
                    $dependencia = "Dependencia ONE";
                    break;
                case "Dependencia Ericsson":
                    $dependencia = "Dependencia Ericsson";
                    break;
                case "Dependencia equipo Replica":
                    $dependencia = "Dependencia equipo Replica";
                    break;
                default:
                    $dependencia = "Sin dependencia";
            }
            $output['data'][] = array(
                $button,
                $data[$i][1],
                $data[$i][2],
                $data[$i][3][$a],
                $data[$i][4][$b],
                $data[$i][5],
                $dependencia
            );
        }
    }
    $i++;
} // /while 



echo json_encode($output);
