<!DOCTYPE html>
<?php
include ('../../conexionbd/session.php');
include ('../../includes/header.php');
include ('../../conexionbd/connectDB.php');
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <i class='fa fa-edit'></i> <big><u>Reporte</u></big></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i>Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Reporte</a></li>
            <li class="active">Reporte por Actividad</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="box box-danger">
                    <div class="box-body box-profile">
                        <!-- DATA TABLE-->
                        <div class="row">
                            <div class="col-md-3">
                                <label><font color="darkred">Actividad :</font></label>
                                <input id="inputTarea" class="form-control" type="text" placeholder="Tarea">
                            </div>
                            <div class="col-md-3">
                                <label><font color="darkred">Arquitecto :</font></label>
                                <input id="inputArqui" class="form-control" type="text" placeholder="Arquitecto">
                            </div>

                            <div class="col-md-3">
                                <label><font color="darkred">Estado :</font></label>
                                <select id="selectEstado" onchange="myPillFilter(7, 'selectEstado')" class="form-control select2" style="width: 100%;">                      
                                    <option value="">Seleccionar</option>
                                    <?php
                                    $url = "../cargar/archivo_trello/u1f2zQ2B.json";
                                    $json = file_get_contents($url);
                                    $obj = json_decode($json, true);
                                    for ($i = 0; $i < count($obj["lists"]); $i++) {
                                       echo "<option value='" . $obj["lists"][$i]["name"] . "'>" . $obj["lists"][$i]["name"] . "</option>";
                                    }
                                    ?> 
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label><font color="red"></font></label>
                                <button id="borrarFiltro" class="buton" name="borrarFiltro" type="button" class="btn btn-danger">Reiniciar</button>
                            </div>
                            <style>
                                .buton {
                                    background-color: red;
                                    border: none;
                                    color: white;
                                    padding: 8px 20px;
                                    text-align: center;
                                    text-decoration: none;
                                    display: inline-block;
                                    font-size: 16px;
                                    margin: 16px 2px;
                                    cursor: pointer;
                                }
                            </style>
                        </div>

                        <section class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="page-heading"><i class="glyphicon glyphicon-edit"></i> Listado Usuarios</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="remove-messages"></div>
                                            <div class="row">
                                                <div class="table-responsive" style="width: 100%;">
                                                    <table class="demo cell-border dataTable" id="manageProductTable" cellspacing="2px;" style="width: 100%;">
                                                        <thead><tr>
                                                                <th class="text-center" style="width: 5%">Arquitecto</th>
                                                                <th class="text-center">Actividad</th>
                                                                <th class="text-center" style="width: 30%">Tipo</th>
                                                                <th class="text-center">Grupo</th>
                                                                <th class="text-center">Gerencia</th>
                                                                <th class="text-center">Responsable</th>
                                                                <th class="text-center">Etapa Arquitectura</th>
                                                                <th class="text-center">Estado Arquitectura</th>
                                                                <th class="text-center">Sub Estado Dependencia</th>
                                                                <th class="text-center">Responsable Dependencia</th>
                                                                <th class="text-center">Fecha Vencimiento</th>
                                                                <th class="text-center">Fecha Inicial Real</th>
                                                                <th class="text-center">Fecha Final Real</th>
                                                             </tr></thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- FIN DATA TABLE -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box image -->
            </div>
        </div>
    </section>
</div> <!-- content-wrapper -->
<script src="componentes/js/funciones.js"></script> 
<?php
include ('../../includes/footer.php');
?>


