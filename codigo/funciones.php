<?php


function error($c, $num)
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

function deslog()
{
    session_destroy();
    echo "<h1>Session Cerrada</h1>";
}

function conectar(&$c)
{
    $host = "localhost";
    // if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == "admin") {
        $usuar = "administrador";
        $clave = "123456";
    // } else {
    //     $usuar = "usuapp";
    //     $clave = "";
    // }
    if ($c = mysqli_connect($host, $usuar, $clave)) {
    } else {
        echo "Imposible conectar";
        exit();
    }
}

function deletebd()
{
    $sql = "DROP DATABASE IF EXISTS Feliz";
    conectar($c);
    if (mysqli_query($c, $sql)) {
        echo "<br>Base de datos eliminada<br>";
    } else {
        error($c, mysqli_errno($c));
    }
}

function crearbd()
{
    conectar($c);
    deletebd();

    $bd = "CREATE DATABASE IF NOT EXISTS Feliz";
    $tabla1 = "CREATE TABLE if not exists Animadores(
        IdAnimador VARCHAR(9) UNIQUE,
        NombreAnimador VARCHAR(35),
        Especialidad VARCHAR(20) PRIMARY KEY,
        precio INT
        );";

    $tabla2 = "CREATE TABLE IF NOT EXISTS Clientes(
        IdCliente INT AUTO_INCREMENT PRIMARY KEY,
        NombreCliente VARCHAR(25),
        Direccion VARCHAR(35),
        Email VARCHAR(25),
        Contraseña VARCHAR(30)
        );";

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


    if (mysqli_query($c, $bd)) {
        echo "<br>Base de datos creada<br>";
        mysqli_select_db($c, "Tragaperras");
        if (mysqli_query($c, $tabla1)) {
            echo "<br>Tabla1 Creada<br>";
            if (mysqli_query($c, $tabla2)) {
                echo "<br>Tabla 2 Creada<br>";
                if (mysqli_query($c, $tabla3)) {
                    echo "<br>Tabla3 Creada<br>";
                }else {
                    error($c, mysqli_errno($c));
                }
            }else {
                error($c, mysqli_errno($c));
            }
        }else {
            error($c, mysqli_errno($c));
        }
    }else {
        error($c, mysqli_errno($c));
    }
}
