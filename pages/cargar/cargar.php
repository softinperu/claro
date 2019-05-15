<!DOCTYPE html>
<?php
include ('../../conexionbd/session.php');
include ('../../includes/header.php');
include ('../../conexionbd/connectDB.php');
?>
<?php
session_start(); 
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <i class='fa fa-edit'></i> <big><u>Carga Input</u></big></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i>Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Carga</a></li>
            <li class="active">Carga Json Trello</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="box box-danger">
                    <div class="box-body box-profile">

                        <section class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="page-heading"><i class="glyphicon glyphicon-edit"></i> Cargar Archivo</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="remove-messages"></div>
                                            <div class="row">
                                                <?php
                                                if (isset($_SESSION['message']) && $_SESSION['message']) {
                                                    printf('<b>%s</b>', $_SESSION['message']);
                                                    unset($_SESSION['message']);
                                                }
                                                ?>
                                                <form method="POST" action="upload.php" enctype="multipart/form-data">
                                                    <div>
                                                        <span>Subir un archivo:</span>
                                                        <input type="file" name="uploadedFile" />
                                                    </div>

                                                    <input type="submit" name="uploadBtn" value="Upload" />
                                                </form>
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


