<?php
require './scripts/segAdmin.php'; // Levanta session y securiza solo para admin
require './scripts/bdutil.php';

function dibujaFormulario() {
    echo '<h2>Introduzca la pregunta y sus respuestas</h2>
        <form action="#" method="post" id="preguntasform">
                Pregunta:<br>
                <textarea rows="2" cols="50" name="pregunta" form="preguntasform">
                </textarea>
                <br>
                Respuesta A:<br>
               <textarea rows="2" cols="50" name="respuesta1" form="preguntasform">
                </textarea>
                <input type="radio" name="correcta" required value="a">
                <br>
                Respuesta B:<br>
                <textarea rows="2" cols="50" name="respuesta2" form="preguntasform">
                </textarea>
                <input type="radio" name="correcta" value="b">
                <br>
                Respuesta C:<br>
                <textarea rows="2" cols="50" name="respuesta3" form="preguntasform">
                </textarea>
                <input type="radio" name="correcta" value="c">
                <br>
                Respuesta D:<br>
                <textarea rows="2" cols="50" name="respuesta4" form="preguntasform">
                </textarea>
                <input type="radio" name="correcta" value="d">
                <br>
                <input type="submit" value="Enviar" name="enviar">
            </form>';
}

function validaRequerido($valor) {
    if (trim($valor) == '') {
        return false;
    } else {
        return true;
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

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="admin.php">aeTest Administrador</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="perfil.php"><i class="fa fa-user fa-fw"></i>Perfil</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i>Configuración</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="scripts/logout.php"><i class="fa fa-sign-out fa-fw"></i>Cerrar sesión</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">

                            <li>
                                <a href="#"><i class="fa fa-dashboard fa-fw"></i>Examen<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="genexam.php">Generar Examen</a>
                                    </li>
                                    <li>
                                        <a href="vexamd.php">Ver Examenes</a>
                                    </li>
                                    <li>
                                        <a href="pexam.php">Publicar Examenes</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Resultados<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="flot.html">Ultimo Examen</a>
                                    </li>
                                    <li>
                                        <a href="morris.html">Anteriores</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="coordenadas.php"><i class="fa fa-table fa-fw"></i>Coordenadas</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i>Preguntas<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">Crear Preguntas</a>
                                    </li>
                                    <li>
                                        <a href="#">Modificar Preguntas</a>
                                    </li>
                                    <li>
                                        <a href="#">Listar Preguntas</a>
                                    </li>
                                    <li>
                                        <a href="#">Eliminar Preguntas</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-wrench fa-fw"></i>Administrar Usuarios</a>   
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

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
                                        <div class="huge">12</div>
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
                                        <div class="huge">124</div>
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
