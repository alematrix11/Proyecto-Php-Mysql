<?php

/*SE EMPIEZA A ELIMINAR DATOS DE LA BASE DE DATOS*/

//Se llama al archivo de conexion
include_once 'conexion.php';

//Se almacena una variable el id que recibimos desde el DOM
$id = $_GET['id'];

//Se especifica que se va a eliminar segun el id
$eliminarDato = 'DELETE FROM colores WHERE id=?';

//Se prepara la sentencia para eliminar
$eliminando = $conex->prepare($eliminarDato);

//Se pasa a ejecutar la sentencia, referenciando al id
$eliminando -> execute(array($id));

//Una vez completada la eliminacion de un dato, la pagina se actualizara
header('location:index.php');

