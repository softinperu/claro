<?php

function validar_errores($dni, $password) {
    $errors = array();
    if (empty($dni) || empty($password)) {
        if ($dni == "") {
            array_push($errors, "Se requiere ingresar DNI");
        }
        if ($password == "") {
            array_push($errors, "Se requiere ingresar contraseña");
        }
    } else {
//        $errors[] = valida_db($dni, $password);
//        array_push($errors, $dni);
//        array_push($errors, $password);
        $errors_db = valida_db($dni, $password);
        foreach ($errors_db as $value) {
            array_push($errors, $value);
        }
    }
    return $errors;
}

function valida_db($dni, $password) {
    //$mysqli = db_connect();
    $errors_db = array();
    $result = mysqli_prepare(DBi::$mysqli, "SELECT * FROM usuarios where codigo = ?");
    $result->bind_param("s", $dni);
    /* ejecutar la consulta */
    $result->execute();
    /* almacenar el resultado */
    $result->store_result();
    if ($result->num_rows == 1) {
        $stmt = mysqli_prepare(DBi::$mysqli, "SELECT u.codigo, u.nombres, u.apellidos, u.rol , u.situacion FROM usuarios u where u.codigo = ? and u.password = ?");
        $stmt->bind_param("ss", $dni, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $value = $result->fetch_assoc();
            if ($value['situacion'] == 1) {

                $_SESSION['user_codigo'] = $value['codigo'];
                $_SESSION['user_nombres'] = $value['nombres'];
                $_SESSION['user_apellidos'] = $value['apellidos'];
                $_SESSION['user_rol'] = $value['rol'];

                echo "<script> window.location='pages/cards2/cards.php'; </script>";
            } else {
                array_push($errors_db, 'Ud. ha sido bloqueado');
            }
        } else {
            array_push($errors_db, 'Su clave es incorrecta.');
        }
    } else {
        array_push($errors_db, 'Error! no se encuentra registrado');
    }


    return $errors_db;
}
