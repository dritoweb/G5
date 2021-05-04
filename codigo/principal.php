<?php
include("funciones.php");

if(isset($_GET['loginUsuario'])){
    loginUsuario();
}
if(isset($_GET['altaUsuario'])){
    altaUsuario();
}
?>