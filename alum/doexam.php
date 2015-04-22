<?php
require '../scripts/segAlu.php'; // Levanta session y securiza alumno
require '../scripts/bdutil.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Francisco Javier Morón Sánchez">

        <title>Plataforma aeTest</title>

        <!-- Bootstrap Core CSS -->
        <link href="../theme/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../theme/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../theme/dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../theme/dist/css/sb-admin-2.css" rel="stylesheet">




        <!-- Custom Fonts -->
        <link href="../theme/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="wrapper">
            <?php require('navbaralu.php'); ?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa  fa-bomb -o fa-fw"></i>Realizar examen                              
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">         
                                <p>Elija la convocatoria de la que se va a examinar.</p>
                                <p>Es necesario introducir la contraseña proporcionada por el profesor para realizar el examen.</p>
                                <p>Un vez pulsado el botón comenzara a contar el tiempo disponible para realizar el examen.</p>
                                <div class="col-xs-5">
                                    <form role="form" method="post" action="../scripts/doexam_action.php">
                                        <div class="form-group">
                                            <label>
                                                Convocatoria
                                            </label>
                                            <select class="form-control" name="id_examen">
                                                <?php
                                                $examenesFind = R::find('examen');

                                                $examenesids = R::getAll('SELECT id from examen');
                                                $examenes = [];
                                                foreach ($examenesids as $examenid) {
                                                    $examenes[] = $examenid['id'];
                                                }
                                                $anulaciones = R::find('anulacion', 'user_id = ?', [$_SESSION['id_usuario']]);

                                                if (empty($anulaciones)) {
                                                    foreach ($examenesFind as $examen) {
                                                        echo '<option value="' . $examen->id . '">' . $examen->nombre . '</option>';
                                                    }
                                                } else {
                                                    foreach ($anulaciones as $anulacion) {
                                                        foreach ($anulacion->sharedExamenList as $examen) {
                                                            if (in_array($examen->id, $examenes)) {
                                                                
                                                            } else {
                                                                echo '<option value="' . $examen->id . '">' . $examen->nombre . '</option>';
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>                                           
                                        </div>
                                        <div class="form-group">                                              
                                            <button class="btn btn-primary" name='enviar' type="submit">
                                                Realizar Examen
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../theme/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../theme/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../theme/bower_components/metisMenu/dist/metisMenu.min.js"></script>



        <!-- Custom Theme JavaScript -->
        <script src="../theme/dist/js/sb-admin-2.js"></script>

    </body>
</html>
