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
            <?php require('navbaralu.php'); ?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-8">
                        <form method="post" action="../scripts/exam_action.php">
                            <div id="preguntas"></div>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h4 class="modal-title" id="myModalLabel">Examen Finalizado</h4>
                                        </div>
                                        <div class="modal-body">
                                            A continuación se enviaran las respuestas del examen.    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="enviar" class="btn btn-primary">Enviar respuestas</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

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
                var notimer = <?php echo $_SESSION['notimer']; ?>;
                if (notimer==1) {} else{
                    $('#countdown').timeTo({
                        seconds: 600,
                        displayHours: false},
                    function () {
                        $('body').addClass("modal-open"),
                                $(".modal-open").css("padding-right", "17px"),
                                $("#myModal").addClass("in"),
                                $("#myModal").attr("aria-hidden", "false"),
                                $("#myModal").css("display", "block"),
                                $("#myModal").css("padding-right", "17px");
                    }
                    );
                }
            });
        </script>
    </body>
</html>
