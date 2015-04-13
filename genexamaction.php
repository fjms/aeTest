<?php
require './scripts/segAdmin.php'; // Levanta session y securiza solo para admin
require './scripts/bdutil.php';

if (!isset($_POST['enviar'])) {
    header('Location: index.php');
} else { // Creamos el examen con sus 10 preguntas.
    if (isset($_POST['nombre_examen']) &&  isset($_POST['codigo_examen'])) {
        $examen = R::dispense('examen');
        $nombre_examen = trim($_POST['nombre_examen']);
        $codigo_examen = trim($_POST['codigo_examen']);
        $examen->nombre = $nombre_examen;
        $examen->codigo = $codigo_examen;
        $repetidos = array();
        $i = 1;
        while ($i <= 10) {
            $id_pregunta = rand(1, 40);
            if (in_array($id_pregunta, $repetidos)) {//Si esta repetido
            } else { //Si no esta repetido
                $i++;
                array_push($repetidos, $id_pregunta);
                $pregunta = R::load('preguntayrespuesta', $id_pregunta);
                $pregunta->sharedExamenList[] = $examen; // Crea tabla intermedia examen_preguntayrespuesta
                R::store($pregunta);
            }
        }
    } else {
        header('Location: genexam.php');
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Francisco Javier Morón Sánchez">

        <title>aeTest - Panel de Administrador</title>

        <!-- Bootstrap Core CSS -->
        <link href="theme/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="theme/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="theme/dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="theme/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="theme/bower_components/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="theme/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    </head>
    <body>
        <div id="wrapper">

            <?php
            require 'navbaradmin.php';
            ?>

            <div id="page-wrapper">


                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa  fa-bomb -o fa-fw">Examen creado</i>                              
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">         
                                <p>El nombre del examen es: <?php echo $nombre_examen . " "; ?>.</p>
                                <p>El código del examen es: <?php echo $examen->codigo . " "; ?>.</p>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="theme/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="theme/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="theme/bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="theme/dist/js/sb-admin-2.js"></script>

    </body>
</html>
