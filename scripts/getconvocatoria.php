<?php
session_start();
if(!isset($_SESSION['rol']) || $_SESSION['rol']!=1){
   header('Location: ../index.php');
}
require './bdutil.php'; // RedBeanPHP 4.1.4

if (isset($_GET['q'])) {
    $id = $_GET['q']; //Validar
    $convocatorias = R::find('resultado','user_id = ? and estado like "firmado"',[$id]);
    
    if(!empty($convocatorias)){
        echo '<div class="panel panel-primary"><div class="panel-heading">';
        echo 'Examenes';
        echo '</div><div class="panel-body">';
        echo '<div class="table-responsive"><table class="table table-striped table-bordered table-hover">';
        echo '
        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Examen</th>
                                            <th>Fecha</th>
                                            <th>Preguntas Correctas</th>
                                            <th>Preguntas Falladas</th>
                                            <th>Nota</th>
                                        </tr>
                                    </thead><tbody>';
    }
    foreach ($convocatorias as $convocatoria) {
        echo '<tr>';
        echo '<td>'.$convocatoria->id.'</td>';
        echo '<td>'.$convocatoria->examen->nombre.'</td>';
        echo '<td>'.$convocatoria->datetime.'</td>';
        echo '<td>'.$convocatoria->p_correctas.'</td>';
        echo '<td>'.$convocatoria->p_incorrectas.'</td>';
        echo '<td>'.round($convocatoria->nota,2).'</td>';
        echo '</tr>';
        
    }
    if(!empty($convocatorias)){
        echo '</tbody></table>';
        echo '</div></div></div>';
    }
}
