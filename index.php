<?php
session_start();

$fila = rand(1, 8);
$col = rand(1, 8);
$posicion = (8 * ($fila - 1)) + ($col - 1);

$_SESSION['posicion'] = $posicion;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aetest la plataforma de test definitiva</title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/btr.min.css" rel="stylesheet">
        <!--Custom style template -->
        <link href="bootstrap/css/cover.css" rel="stylesheet">

    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="index.php"><img src="bootstrap/img/upo.png" alt="Logo Upo"></a>
                </div>
            </div>
        </div>

        <div class="container">
            <div id="login-wraper">
                <form action="scripts/login.php" method="post" class="form login-form">
                    <legend>Acceso <span class="blue">aeTest</span></legend>
                    <div class="body">
                        <?php
                        if (isset($_SESSION['errorlogin'])) {
                            ?>
                        <div class="alert-danger">Datos incorrectos. Por favor verifique sus datos e inténtelo de nuevo.</div>
                            <?php
                            unset($_SESSION['errorlogin']);
                        }
                        ?>
                        <label>DNI</label>
                        <input type="text" class="form-control" name='dni' placeholder="12345678A">
                        <label>Coordenadas <span class="blue">F<?php echo $fila ?></span><span class="blue">C<?php echo $col ?></span></label><br>
                        <input type="password" class="form-control" name='password'>

                    </div>
                    <div class="footer">
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>

                </form>
            </div>

        </div>

        <footer class="white navbar-fixed-bottom">
            ¿Perdió su tabla de coordenadas? <a href="viafirma/certificado.php" class="btn btn-black">Entrar con Certificado Digital</a>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/backstretch.min.js"></script>
        <script src="bootstrap/js/typica-login.js"></script>
    </body>
</html>
