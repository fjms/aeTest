<?php
require 'rb.php'; // RedBeanPHP 4.1.4
R::setup( 'mysql:host=localhost;dbname=aetest','root', '' );
/*
list($est1,$est2) = R::dispense( 'estudiante',2 );
$est1->dni = '12345678A';
$est1->password = '12345';
$est2->dni = '12345678B';
$est2->password = '123';

$examen = R::dispense('examen');
$examen->name ='Examen AE';
$est1->sharedExamenList[] = $examen;
$est2->sharedExamenList[] = $examen;

R::storeAll([$est1,$est2]);
*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $nota = R::findOne('estudiante_examen','where examen_id = ? and estudiante_id = ?',['1','2']);
        echo $nota->num_aprobadas;
        echo $nota->num_suspensas;
        echo $nota->resultado;
        echo $nota->id;
        ?>
    </body>
</html>
