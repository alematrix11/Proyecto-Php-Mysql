<?php 
      
    /*SE EMPIEZA A EDITAR A LA BASE DE DATOS*/

     //Se crean la variables y se les pasan los datos para editar con el metodo GET
        $id = $_GET['id'];
        $color = $_GET['color'];
        $descripcion = $_GET['desc'];
    
    //Para editar debemos llamar a la conexion

    include_once 'conexion.php';

    //Se crea una variable donde se indica los campos que pueden ser editados
        $editaColor = 'UPDATE colores SET color=?, descripcion=? WHERE id=?';
    
    //Se prepara la sentancia que se establecio
        $editando = $conex -> prepare($editaColor);
        
    //Para editar, cuando ejecutamos la sentencia debemos establecer el id
        $editando -> execute(array($color,$descripcion,$id));

    //Establecemos una actualizacion para que se edite inmediatamente
    header('location:index.php');
    
    
    //Cerramos la conexion
    $conex = null;

    //Cerramos la sentencia
    $editando = null;

?>