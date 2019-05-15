<?php

$miembros = array();
$etiquetas = array();
$data = array();
$lists = array();

$url = "../../../../includes/u1f2zQ2B.json";
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
echo "asd";
    /* id del card */
    $data[$i][0] = $obj["cards"][$i]["id"];

    /* miembros del equipo concatenado */
    if (count($obj["cards"][$i]["idMembers"]) > 0) {
        for ($a = 0; $a < count($obj["cards"][$i]["idMembers"]); $a++) {
            for ($b = 0; $b < count($obj["members"]); $b++) {
                if ($obj["cards"][$i]["idMembers"][$a] === $miembros[$b][0]) {
                    $data[$i][1] = $data[$i][1] . $miembros[$b][1] . ",";
                }
            }
        }
    } else {
        $data[$i][1] = "No asignado";
    }

    /*     * ****************** etiquetas ****************** */

    if (count($obj["cards"][$i]["labels"]) > 0) {
        for ($c = 0; $c < count($obj["cards"][$i]["labels"]); $c++) {
            $atiquetas_card[$i][$c][0] = $obj["cards"][$i]["labels"][$c]["name"];
            $atiquetas_card[$i][$c][1] = $obj["cards"][$i]["labels"][$c]["color"];
        }
    } else {
        $atiquetas_card[$i][0][0] = "";
        $atiquetas_card[$i][0][1] = "";
    }
    /*tipo*/
    for ($d = 0; $d < count($atiquetas_card[$i]); $d++) {
        if($atiquetas_card[$i][$d][1]==="green"){
            $data[$i][2]=$atiquetas_card[$i][$d][0];
        }
    }


}

$output = array('data' => array());
$i = 0;

while ($i < count($obj["cards"])) {

           
            $output['data'][] = array(
         
                $data[$i][1],
                $data[$i][2]
                
            );
     
} // /while 



echo json_encode($output);
