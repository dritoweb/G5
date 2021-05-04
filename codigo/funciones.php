<?php

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

function login()
{
    //Funcion para iniciar sessiones de administrador (Parte1) o usuario (Parte2)

    //*Parte1*\\

    //Claves del Administrador
    //Nombre: "administrador"
    //Contraseña: "123456"

    if ($_POST['nombre'] == "administrador" && $_POST['password'] == "123") {
        echo "<h1>Eres Administrador</h1>";
        $_SESSION['tipo'] = "admin";
        $_SESSION['nombre'] = "Administrador";
    }

    //*Parte2*\\
    else {
        $a = 0; //Contador para comprobar si existe el usuario

        $nombre = $_POST['nombre'];
        $clave = $_POST['password'];

        conectar($c); //Llamada funcion de conectar

        mysqli_select_db($c, "feliz");
        $sql = "SELECT * FROM clientes";

        $vec = mysqli_query($c, $sql);

        while ($fila = mysqli_fetch_row($vec)) {
            if ($fila[1] == $nombre && $fila[2] == $clave) {
                $a = 1;
            }
        }

        if ($a == 1) {
            //El usuario existe
            echo "<h1>Te has logeado</h1>";
            $_SESSION['tipo'] = "usuario";
            $_SESSION['nombre'] = $nombre;
        } else {
            //El usuairo no existe
            echo "<h1> Error Login</h1>";
        }
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
