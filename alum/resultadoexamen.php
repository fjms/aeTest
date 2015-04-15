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
                                <i class="fa  fa-bar-chart-o fa-fw"></i>Resultados                        
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php
                                $resultado = R::load('resultado', $_SESSION['id_resultado']);
                                echo $resultado->user->nombre . ' ' . $resultado->user->apellidos . '<br>';
                                echo 'Examen: ' . $resultado->examen->nombre . '<br>';
                                echo 'Fecha: ' . $resultado->fecha . '<br>';
                                echo 'Nota: ' . $resultado->nota;

                                $exam = R::load('examen', $resultado->examen->id);
                                $respuestas = json_decode($resultado->respuestas);
                                $i = 0;
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Pregunta</th>
                                                <th>Resultado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($exam->sharedPreguntayrespuestaList as $pregunta) {
                                                $n = $i + 1;
                                                if ($pregunta->correcta === $respuestas[$i]) {
                                                    echo'<tr><th>' . $n . '</th><th>Acertada</th></tr>';
                                                } else if($respuestas[$i]==='x') {
                                                    echo'<tr><th>' . $n . '</th><th>No contestada</th></tr>';
                                                } else {
                                                    echo'<tr><th>' . $n . '</th><th>Fallada</th></tr>';
                                                }
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>  
                                </div>
                            </div>
                            <!-- /.panel-body -->
                            <div class="panel-footer">
                                <button class="btn btn-primary" name='enviar' type="submit">
                                                Firmar Examen
                                            </button>
                            </div>
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
