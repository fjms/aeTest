<?php
session_start();
if(!isset($_SESSION['rol']) || $_SESSION['rol']!=0){
   header('Location: ../index.php');
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

