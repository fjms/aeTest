<?php
require './scripts/segAdmin.php'; // Levanta session y securiza solo para admin
require './scripts/bdutil.php';


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
                    <div class="col-lg-12">
                        <h1 class="page-header">Panel de Control</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php
                                            echo R::count('preguntayrespuesta');                                            
                                            ?>
                                        </div>
                                        <div>Preguntas</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Listar Preguntas</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa  fa-bar-chart-o  fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php
                                            echo R::count('resultado','nota >= 5 and estado like "firmado"');                                            
                                            ?></div>
                                        <div>Examenes Aprobados</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver Detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bar-chart-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php
                                            echo R::count('resultado','nota < 5 and estado like "firmado"');                                            
                                            ?></div>
                                        <div>Examenes Suspendidos</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver Detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php
                                            echo R::count('user','rol = 0');
                                            ?>
                                        </div>
                                        <div>Usuarios</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Administrar Usuarios</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i>Resultados Ultimo Examen                               
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
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

        <!-- Morris Charts JavaScript -->
        <script src="theme/bower_components/raphael/raphael-min.js"></script>
        <script src="theme/bower_components/morrisjs/morris.min.js"></script>
        <script src="theme/js/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="theme/dist/js/sb-admin-2.js"></script>
        <?php /* dibujaFormulario();


          if (!isset($_POST['enviar'])) {

          } else {
          $errores = array();
          if (!validaRequerido($_POST['pregunta'])) {
          $errores[] = 'El campo pregunta es incorrecto.';
          }
          if (!validaRequerido($_POST['respuesta1'])) {
          $errores[] = 'El campo respuesta A es incorrecto.';
          }
          if (!validaRequerido($_POST['respuesta2'])) {
          $errores[] = 'El campo respuesta B es incorrecto.';
          }
          if (!validaRequerido($_POST['respuesta3'])) {
          $errores[] = 'El campo respuesta C es incorrecto.';
          }
          if (!validaRequerido($_POST['respuesta4'])) {
          $errores[] = 'El campo respuesta D es incorrecto.';
          }
          if (!validaRequerido($_POST['correcta'])) {
          $errores[] = 'Error! Debe indicar una respuesta valida.';
          }
          if (!$errores) {
          $pregunta = R::dispense('preguntayrespuesta');
          $pregunta->pregunta = trim($_POST['pregunta']);
          $pregunta->respuesta1 = trim($_POST['respuesta1']);
          $pregunta->respuesta2 = trim($_POST['respuesta2']);
          $pregunta->respuesta3 = trim($_POST['respuesta3']);
          $pregunta->respuesta4 = trim($_POST['respuesta4']);
          $pregunta->correcta = trim($_POST['correcta']);
          $id_pregunta = R::store($pregunta);
          echo "Respuesta guardada con id ".$id_pregunta;
          }
          ?>
          <?php if ($errores): ?>
          <ul style="color: #f00;">
          <?php foreach ($errores as $error): ?>
          <li> <?php echo $error ?> </li>
          <?php endforeach; ?>
          </ul>
          <?php
          endif;
          }
         */ ?>
    </body>
</html>
