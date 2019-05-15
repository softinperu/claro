<?php

$miembros = array();
$etiquetas = array();
$data = array();
$lists = array();
$etiquetas_card = array();

$url = "u1f2zQ2B.json";
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

$i;
for ($i = 0; $i < 4; $i++) {

    /* id del card */
    $data[$i][0] = $obj["cards"][$i]["id"];

    /* miembros del equipo concatenado */
    if (count($obj["cards"][$i]["idMembers"]) > 0) {
        $comodin = "";
        for ($a = 0; $a < count($obj["cards"][$i]["idMembers"]); $a++) {
            for ($b = 0; $b < count($obj["members"]); $b++) {
                if ($obj["cards"][$i]["idMembers"][$a] === $miembros[$b][0]) {
                    $data[$i][1] = $comodin . $miembros[$b][1] . ",";
                    $comodin = $data[$i][1];
                }
            }
        }
        $data[$i][1] = trim($data[$i][1], ',');
    } else {
        $data[$i][1] = "No asignado";
    }

    /*     * *************** etiquetas ****************** */
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
            $data[$i][2] = $etiquetas_card[$i][$d][0];
          } else {
            $data[$i][2] = "";
        }
    }
}


$output = array('data' => array());
$i = 0;

while ($i < 4) {


    $output['data'][] = array(
        $data[$i][1],
        $obj["cards"][$i]["name"],
        $etiquetas_card[$i][0][0],
        count($etiquetas_card[$i]),
        $data[$i][2]
    );
    $i++;
} // /while 



echo json_encode($output);
