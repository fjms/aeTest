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
        <?php
            require 'navbaradmin.php';
            ?>
        <div id="wrapper">

            

            <div id="page-wrapper">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa fa-users  -o fa-fw"></i>Informe por alumno                              
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">         
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="data-alumnos" >
                                        <thead>
                                            <tr class="">
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>     
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <div id="examenes"></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel-info">
                            <div class="panel-heading">
                                <i class="fa fa-search fa-fw"></i>
                                Consulta de convocatorias
                            </div>
                            <div class="panel-body">
                                <p>Haga click sobre una fila de la tabla alumnos para visualizar las convocatorias del alumno seleccionado.</p>
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
                var table = $('#data-alumnos').dataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "scripts/spealu.php"
                });
                $('#data-alumnos tbody').on('click', 'tr', function () {
                    var id = $('td', this).eq(0).text();
                    if ($(this).hasClass('info')) {
                        $(this).removeClass('info');
                    }
                    else {
                        table.$('tr.info').removeClass('info');
                        $(this).addClass('info');
                    }
                    $("#examenes").load("scripts/getconvocatoria.php?q=" + id);
                });
            });
        </script>
    </body>
</html>
