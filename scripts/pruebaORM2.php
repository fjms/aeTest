<?php
require 'rb.php'; // RedBeanPHP 4.1.4
R::setup( 'mysql:host=localhost;dbname=aetest','root', '' );
/* Descomentar la primera vez para que introduzca el usuario
$user = R::dispense( 'user' );
$user->dni = '12345678A';
$user->password = '12345';
$id = R::store( $user );
*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p> Buscar por dni por id</p>
        <?php
        $user = R::load( 'user', 1 ); //reloads our book
        echo $user->dni;
        ?>
        <p> Buscar lista por campo</p>
        <?php
        $user2  = R::find( 'user', ' dni  LIKE ? ', [ '12345678A' ] );
        echo $user2[1];
        ?>
        <p> Buscar uno por campo</p>
        <?php
        $dnipost = '12345678A';
        $user3  = R::findOne( 'user', ' dni  LIKE ? ', [ $dnipost ] );
        echo $user3->dni."<br>";       
        echo $user3->password;
        ?>
    </body>
</html>
