<?php
require './scripts/segAdmin.php'; // Levanta session y securiza solo para admin
?>
<!DOCTYPE html>
<html lang="es">
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
        <!-- DataTables CSS -->
        <link href="theme/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
        <!-- Datatable Responsive-->
        <link href="theme/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="theme/dist/css/sb-admin-2.css" rel="stylesheet">
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
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa  fa-bomb -o fa-fw"></i>Examenes                              
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">         
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="data-examenes" >
                                        <thead>
                                            <tr class="">
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Password</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>     
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <div id="preguntas"></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel-info">
                            <div class="panel-heading">
                                <i class="fa fa-search fa-fw"></i>
                                Consulta de preguntas
                            </div>
                            <div class="panel-body">
                                <p>Haga click sobre la fila de la tabla Examenes para visualizar las preguntas generadas para dicha convocatoria.</p>
                            </div>
                        </div>
                        <div class="panel-info" id="soluciones">
                            
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
        <!-- DataTable -->
        <script src="theme/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="theme/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="theme/dist/js/sb-admin-2.js"></script>



        <script>
            $(document).ready(function () {
                var table = $('#data-examenes').dataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "scripts/spexam.php"
                });
                $('#data-examenes tbody').on('click', 'tr', function () {
                    var id = $('td', this).eq(0).text();
                    if ($(this).hasClass('info')) {
                        $(this).removeClass('info');
                    }
                    else {
                        table.$('tr.info').removeClass('info');
                        $(this).addClass('info');
                    }
                    $("#preguntas").load("scripts/getexam.php?q=" + id);
                    $("#soluciones").load("scripts/getsol.php?q=" + id);
                });
            });
        </script>
    </body>
</html>
