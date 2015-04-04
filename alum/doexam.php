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
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="alumno.php">aeTest Alumno</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i>Perfil</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i>Configuración</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="../scripts/logout.php"><i class="fa fa-sign-out fa-fw"></i>Cerrar sesión</a>
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
                                        <a href="doexam.php">Realizar examen</a>
                                    </li>
                                    <li>
                                        <a href="#">Mis respuestas</a>
                                    </li>
                                    <li>
                                        <a href="#">Anular examenes pendientes</a>
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
                                                    $examenes = R::find('examen','estado LIKE "creado"');
                                                    foreach ($examenes as $examen) {                                                     
                                                        echo '<option value="'.$examen->id.'">'.$examen->nombre.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <label>
                                                    Contraseña Examen
                                                </label>
                                                <input type="password" class="form-control" name="password_examen" required></input>
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
