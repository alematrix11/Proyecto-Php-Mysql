<?php 

//Call to file conexion.php
include_once 'conexion.php';

//Se establece un mensaje de que se inicia el archivo index
echo 'Se inicializo el archivo index.php'.'<br>';


/*SE EMPIEZA A LEER DE LA BASE DE DATOS*/

//Se debe realizar la sentencia sql
//Se establece que se va a leer la tabla de la base de datos1
$sql_read = 'SELECT * FROM colores';

//Se debe crear una variable que traiga la conexion la base de datos y prepare la sentencia
$sql_brind = $conex->prepare($sql_read);

//var_dump($sql_brind);

//Se realiza la ejecucion de la sentencia sql
$sql_brind->execute();

//Para ver el resultado de la variable que se ejecuto utilizamos el metodo fetchAll
$result = $sql_brind->fetchAll();

//var_dump($result);


/*SE EMPIEZA A AGREGAR DATOS A LA BASE DE DATOS*/

//Se verifica si los datos va a ser enviados por el metodo POST
if($_POST){
    
    //Luego de verificar se almacena los datos en la variable
    $guardaColor = $_POST['color'];
    $guardaDesc = $_POST['desc'];
    
    //Se establece una sentencia para agregar datos a la variable
    //Se debe espicificar nombre de la tabla de la base de datos y los nombres de los campos de la tabla, y luego los datos que se envian con PHP
    $agregaSQL = 'INSERT INTO colores (color, descripcion) VALUES (?, ?)';
    
    //Se debe preparar la consulta, se llama a la conexion de la base de datos y se le pasa la variable SQL
    $agregando = $conex->prepare($agregaSQL);
        
    //Una vez preparada la consulta, procedemos a ejecutarla, estableciendo los datos que se guardaron por el usuario
    $agregando->execute(array($guardaColor, $guardaDesc));
    
    //Establecemos una actualizacion para que se agregue inmediatamente
    header('location:index.php');
    
}


//Empezo a agregar mas codigo el viernes de 30 de agosto

//Se detecta si hay un metodo GET
if($_GET){
    
    //Se captura el valor del metodo GET con el id, y se lo guarda en una variable
    $id = $_GET['id'];
    
    //Se debe leer la base de datos y la tabla colores
    $soloId = 'SELECT * FROM colores WHERE id=?';
    
    //Se pasa a prepara la sentencia
    $guardaId = $conex -> prepare($soloId);
    
    //Se pasa a ejecutar la sentencia
    $guardaId -> execute(array($id));
    
    //Obtenemos el resultado
    $resultId = $guardaId->fetch();
    
    //Obtenemos informacion sobre el resultado
    //var_dump($resultId);
    
}


?>


<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Proyecto usando PHP y MYSQL</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!--File de CSS de Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!--Files the FontAwesome CSS-->
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all">
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all">
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
    
</head>

<body>
    
    <h1>Proyecto de PHP con MSQL</h1>
    
    <div class="container mt-5">
        <div class="row">
            
            <!--Se imprimen datos de la base de datos en el DOM-->
            <div class="col-md-6">
                 
                <?php 
                    //Se define un foreach para recorrer los datos de la tabla
                    foreach ($result as $dato):
                ?>
                 
                <div class="alert alert-<?php echo $dato['color'] ?>" role="alert">
                    El alerta de Bootstrap esta funcionando.
                    <?php echo '<br>'.'La descripcion del color es: '.$dato['descripcion'] ?>
                    
                    <!--Se agrega icono de awesome para eliminar-->
                    <!--Se referencia el campo a eliminar por medio de href, utilizando su id-->
                    <a href="eliminar.php?id=<?php echo $dato['id'] ?>" class="float-right ml-4">
                        <i class="far fa-trash-alt">
                            
                        </i>
                    </a>
                    
                    <!--Se agrega icono de awesome para editar-->
                    <!--Se referencia el campo a editar por medio de href, utilizando su id-->
                    <a href="index.php?id=<?php echo $dato['id'] ?>" class="float-right">
                        <i class="fas fa-pencil-alt">
                            
                        </i>
                    </a>
                            
                    
                </div>
            
                <?php endforeach ?>
                        
            </div>
            
            <!--Se crea un formulario para mandar nuevos datos desde el DOM a la Base de datos-->
            <div class="col-md-6">
                
                <?php if(!$_GET): ?>
                <!--Formulario para agregar elementos-->
                <form class="form" method="POST">
                    
                    <h2>Agregando colores</h2>
                    
                    <label for="color" class="">Ingresar color:</label>
                    <input class="form-control " id="color" name="color" type="text">
                    <label for="desc" class="mt-2">Ingresar descripcion:</label>
                    <input class="form-control" id="desc" name="desc" type="text">
                    <button class="btn btn-primary mt-3" type="submit">Agregar color</button>
                </form>
                <?php endif ?>
                
                
                <?php if($_GET): ?>
                <!--Formulario para editar elementos-->
                <form action="editar.php" class="form" method="GET">
                    
                    <h2>Editando colores</h2>
                    
                    <label for="color" class="">Editar color:</label>
                    <input class="form-control " id="color" name="color" type="text" value="<?php echo $resultId['color'] ?>">
                    <label for="desc" class="mt-2">Editar descripcion:</label>
                    <input class="form-control" id="desc" name="desc" type="text" value="<?php echo $resultId['descripcion'] ?>">
                    <input type="hidden" name="id" value="<?php echo $resultId['id'] ?>">
                    <button class="btn btn-primary mt-3" type="submit">Editar color</button>
                </form>
                <?php endif ?>
                
            </div>
            
        </div>
    </div>
    
    
    <!--File JS de JQuery-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <!--File JS de Popper-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    
    <!--File JS de Bootstrap-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>