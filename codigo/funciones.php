<?php
session_start();

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
            setcookie("nombre",$nombre,time()+3600,"/");
            $contador++;
        }
        else
        {
            $mensaje="Contraseña incorrecta, prueba con 123456";

        }
    }
    else
    {
        $host = "localhost";
        $usuar = "administrador";
        $clave = "123456";
        $mensaje="Sesion no iniciada";
        if ($c = mysqli_connect($host, $usuar, $clave)) 
        {
            echo "vacio";
        }
        else 
        {
            echo "Imposible conectar";
        }
        $base="Feliz"; 
        $tabla="Clientes"; 
        mysqli_select_db($c, $base); 
        $usuarios=mysqli_query($c, "SELECT NombreCliente FROM  Clientes");
        foreach($usuarios as $Columna=>$datos)
        {  
            foreach($datos as $dato=>$informacion)
            {
                if("$nombre"=="$informacion")
                {
                    $mensaje="$mensaje $informacion";
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
    echo "$mensaje";   
    header("Location: principal.php");   
}

function cerrarsesion()
{
    session_destroy();
    setcookie("nombre","",time()-1,"/");
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

    if (mysqli_query($c, $sql)) {
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
        IdAnimador VARCHAR(9) UNIQUE,
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
        mysqli_select_db($c, "Tragaperras");
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
?>
