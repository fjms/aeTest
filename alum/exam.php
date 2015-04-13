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
        <!-- TimeTo JQuery Plugin -->
        <link href="../bootstrap/css/timeTo.css" rel="stylesheet" type="text/css">


    </head>
    <body class="" style="">
        <div id="wrapper">
            <!-- Navigation -->
           <?php require('navbaralu.php');?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-8">
                        <form method="post" action="../scripts/exam_action.php">
                            <div id="preguntas"></div>

                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel-info">
                            <div class="panel-heading">
                                <i class="fa fa-clock-o fa-fw"></i>
                                Tiempo Restante
                            </div>
                            <div class="panel-body" id="countdown">

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

        <script src="../bootstrap/js/jquery.timeTo.min.js"></script>


        <!-- Custom Theme JavaScript -->
        <script src="../theme/dist/js/sb-admin-2.js"></script>
        <script>
            $(document).ready(function () {
                $("#preguntas").load("../scripts/getexamen.php");
                $('#countdown').timeTo({
                    seconds: 600,
                    displayHours: false},
                function () {
                    alert('Se acabo el tiempo');
                }
                );
            });
        </script>
    </body>
</html>
