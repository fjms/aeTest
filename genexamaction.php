<?php
require './scripts/segAdmin.php'; // Levanta session y securiza solo para admin
require './scripts/bdutil.php';

if (!isset($_POST['enviar'])) {
    header('Location: index.php');
} else { // Creamos el examen con sus 10 preguntas.
    if (isset($_POST['nombre_examen']) && isset($_POST['password_examen'])) {
        $examen = R::dispense('examen');
        $nombre_examen = trim($_POST['nombre_examen']);
        $examen->nombre = $nombre_examen;
        $examen->estado = 'creado';
        $examen->password = trim($_POST['password_examen']);
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
                                <a href="#"><i class="fa fa-wrench fa-fw"></i>Administracion Usuarios</a>   
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">


                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa  fa-bomb -o fa-fw"></i>                              
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">         
                                <p>Examen con nombre: <?php echo $nombre_examen . " "; ?> creado correctamente.</p>
                                <p>La contraseña del examen es: <?php echo $examen->password . " "; ?>.</p>
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
