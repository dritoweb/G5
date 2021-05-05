<?php

function loginUsuario(&$mensaje)
{
    $nombre=$_POST["nombre"];
    $password=$_POST["password"];
    $mensaje="";
    $contador=0;
    if($nombre == "administrador")
    {
        if( $password == "123456")
        {
            $mensaje="Sesion iniciada con $nombre";
            
            $_SESSION["tipo"]="admin";
            $_SESSION['nombre']="Administrador";

            $contador++;
        }
        else
        {
            $mensaje="Contraseña incorrecta";
        }
    }
    else
    {
        conectar($c);

        mysqli_select_db($c, "Feliz");

        $usuarios=mysqli_query($c, "SELECT NombreCliente FROM  Clientes");
        foreach($usuarios as $Columna=>$datos)
        {  
            foreach($datos as $dato=>$informacion)
            {
                if("$nombre"=="$informacion")
                {
                    setcookie("nombre",$nombre,time()+3600,"/");
                    $mensaje="Sesion iniciada con $nombre";
                    $contador++;
                }
                else
                {
                    $mensaje="El usuario $nombre no existe";
                }
            }
        }
    }
    header("refresh:3 url=../");
}

function cerrarsesion()
{
    session_destroy();
    header("Location: ../index.html");  
}

function error($c, $num)        //Funcion para ver errores en funciones mysqli, para llamarla pasar coneccion y mysqli_errno($c)
{
    $vec["1064"] = "<br>Error de sintaxis<br>";
    $vec['1046'] = "<br>Base de datos no seleccionada<br>";
    $vec['1062'] = "<br>Este usuario ya existe<br>";
    $vec['1146'] = "<br>Esta tabla no existe<br>";
    $vec['1054'] = "<br>Falta algun campo en las tablas";

    if (isset($vec[$num])) {
        echo $vec[$num];
    } else {
        echo "Error desconocido: " . mysqli_errno($c);
    }
}

function conectar(&$c)
{
    //Funcion para conectar en todas las consultas de Mysqli, El unico parametro de salida es la coneccion
    //Requiere "session_start();"
    $host = "localhost";

    //Existe la session tipo (Hay un usuario logeado)
    //y la session vale "admin" (El usuairo es de tipo admin)
    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == "admin") {
        $usuar = "administrador";
        $clave = "123456";
    } else {

        //No hay un admin conectado, da igual que se este log o no

        $usuar = "usuapp";
        $clave = "";
    }
    if ($c = mysqli_connect($host, $usuar, $clave)) {
        //Posible conectar
    } else {
        echo "Imposible conectar";
        exit();
    }
}

function deletebd()
{
    conectar($c);   //Coneccion con BD
    $sql = "DROP DATABASE IF EXISTS Feliz";

    if (mysqli_query($c, $sql)) {   //Borrar BD
        echo "<br>Base de datos eliminada<br>";
    } else {
        error($c, mysqli_errno($c));
    }
}

function crearbd()
{
    conectar($c);
    deletebd(); //Borrar BD si existe

    //Crear BD
    $bd = "CREATE DATABASE IF NOT EXISTS Feliz";

    //Crear trabla Animadores
    $tabla1 = "CREATE TABLE if not exists Animadores(   
        IdAnimador VARCHAR(9),
        NombreAnimador VARCHAR(35),
        Especialidad VARCHAR(20) PRIMARY KEY,
        precio INT
        );";

    //Crear tabla Clientes
    $tabla2 = "CREATE TABLE IF NOT EXISTS Clientes(
        IdCliente INT AUTO_INCREMENT PRIMARY KEY,
        NombreCliente VARCHAR(25),
        Direccion VARCHAR(35),
        Email VARCHAR(25),
        Contraseña VARCHAR(30)
        );";

    //Crear tabla Fiesta
    $tabla3 = "CREATE TABLE IF NOT EXISTS Fiesta(
        IdFiesta INT,
        fecha DATE,
        Especialidad VARCHAR(20),
        Duracion INT,
        TipoDeFiesta VARCHAR(20),
        Numero VARCHAR(9),
        EdadMedia INT,
        Importe INT,
        IdCliente INT,
        FOREIGN KEY (Especialidad) REFERENCES Animadores(Especialidad),
        FOREIGN KEY (IdCliente) REFERENCES Clientes(IdCliente),
        PRIMARY KEY(Fecha, Especialidad)
        );";


    //Creaccion
    if (mysqli_query($c, $bd)) {
        echo "<br>Base de datos creada<br>";
        mysqli_select_db($c, "Feliz");
        if (mysqli_query($c, $tabla1)) {
            echo "<br>Tabla1 Creada<br>";
            if (mysqli_query($c, $tabla2)) {
                echo "<br>Tabla 2 Creada<br>";
                if (mysqli_query($c, $tabla3)) {
                    echo "<br>Tabla3 Creada<br>";
                } else { //errores
                    error($c, mysqli_errno($c));
                }
            } else {
                error($c, mysqli_errno($c));
            }
        } else {
            error($c, mysqli_errno($c));
        }
    } else {
        error($c, mysqli_errno($c));
    }
}

function AltaAnimador(){
    
    if (isset($_POST['dni']) AND ($_POST['nombre']) AND isset($_POST['espec']) AND isset($_POST['precio'])) {
        
        conectar($c);
        mysqli_select_db($c, "Feliz");
        $dni=$_POST['dni'];
        $nombre = $_POST['nombre'];
        $espec = $_POST['espec'];
        $precio = $_POST['precio'];

        $sql = "INSERT INTO animadores(IdAnimador, NombreAnimador, Especialidad, precio) VALUES('$dni', '$nombre', '$espec', '$precio')";
        if (mysqli_query($c, $sql)) {
            echo "Animador agregado";
        } else {
            error($c, mysqli_errno($c));
        }
    }else{
        echo "Imposible añadir al animador, faltan datos";
    }

}

function animadores2(&$vec)
{
    conectar($c);
    mysqli_select_db($c, "feliz");

    $sql = "SELECT CONCAT(NombreAnimador, ' - ', Especialidad) FROM animadores";
    $vec = mysqli_query($c, $sql);
}