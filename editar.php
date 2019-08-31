<?php 
      
     //Se crean la variables y se les pasan los datos para editar con el metodo GET
        $id = $_GET['id'];
        $color = $_GET['color'];
        $descripcion = $_GET['desc'];

    //Se crea una variable donde se indica los campos que pueden ser editados
        $editaSQL = 'UPDATE colores SET color=?, desc=? WHERE id=?';
    
    //Se prepara la sentancia que se establecio
        $editando = $conex -> prepare($editaSQL);
        
    //Para editar, cuando ejecutamos la sentencia debemos establecer el id
        $editando -> execute(array($color,$descripcion,$id));

    //Establecemos una actualizacion para que se edite inmediatamente
    header('location:index.php');

?>
