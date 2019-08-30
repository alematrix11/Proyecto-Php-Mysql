<?php

    //Conexion y su administracion
    
    //Guarda la conexion dentro de una variable

    //Se verifica si la conexion es correcta, y en caso de lo que no lo sea se devuelve un mensaje
    
    //Copiamos los parametros de la conexion dentro de una variable
    //Se conecta a mysql, pasando el host y la base de datos
    $link = 'mysql:host=localhost;dbname=basecolores';

    //Se crea una variable para guardar los datos de la conexion de el usuario del servidor local
    $user = 'root';
    $pass = '';

    try{
        //Se crea una variable que contendra los 3 parametros de conexion
        $conex = new PDO($link, $user, $pass);
        
        echo 'Se ha establecido la conexion'.'<br>';
        
        //Se establece un foreach que recorre la conexion, se selecciona la tabla, y guarda el arreglo en una variable fila
        /*foreach($conex->query('SELECT * from `colores`') as $fila){
            print_r($fila);
        }*/
        
    }
    catch (PDOException $e) {
        print "¡Error!: ".$e->getMessage()."<br>";
        die();
    }

?>