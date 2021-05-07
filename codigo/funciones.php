<?php

function loginUsuario(&$mensaje)
{
    //Datos del usuario/admin
    $nombre = $_POST["nombre"];
    $password = $_POST["password"];
    $mensaje = "";
    $contador = 0;

    //Es admin?
    if ($nombre == "administrador") {
        if ($password == "123456") {
            $mensaje = "Sesion iniciada con $nombre";

            $_SESSION["tipo"] = "admin";
            $_SESSION['nombre'] = "Administrador";

            $contador++;
        } else {
            $mensaje = "Contraseña incorrecta";
        }
        //Es usuario?
    } else {
        conectar($c);

        mysqli_select_db($c, "Feliz");

        $usuarios = mysqli_query($c, "SELECT NombreCliente FROM  Clientes");
        foreach ($usuarios as $Columna => $datos) {
            foreach ($datos as $dato => $informacion) {
                if ("$nombre" == "$informacion") {
                    $_SESSION["tipo"] = "usuario";
                    $_SESSION['nombre'] = "$nombre";
                    $mensaje = "Sesion iniciada con $nombre";
                    $contador++;
                } else {
                    //No hay usuario
                    $mensaje = "El usuario $nombre no existe";
                }
            }
        }
    }
    header("location:../");
}

function cerrarsesion()
{
    session_destroy();
    header("Location: ../index.php");
}

function error($c, $num)        
{//Funcion para ver errores en funciones mysqli,
 //para llamarla pasar coneccion y mysqli_errno($c)

    $vec['1046'] = "<br>Base de datos no seleccionada<br>";
    $vec['1054'] = "<br>Falta algun campo en las tablas<br>";
    $vec['1062'] = "<br>Este registro ya existe<br>";
    $vec["1064"] = "<br>Error de sintaxis<br>";
    $vec['1146'] = "<br>Esta tabla no existe<br>";
    $vec['1452'] = "<br>Clave externa desconocida<br>";

    //tipo de error
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
        IdFiesta INT AUTO_INCREMENT ,
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

function AltaAnimador()
{//Registrar animador

    if (isset($_POST['dni']) and ($_POST['nombre']) and isset($_POST['espec']) and isset($_POST['precio'])) {
        //todo relleno
        conectar($c);
        mysqli_select_db($c, "Feliz");
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $espec = $_POST['espec'];
        $precio = $_POST['precio'];

        //mysqli
        $sql = "INSERT INTO animadores(IdAnimador, NombreAnimador, Especialidad, precio) VALUES('$dni', '$nombre', '$espec', '$precio')";
        if (mysqli_query($c, $sql)) {
            echo "Animador agregado";
        } else {
            error($c, mysqli_errno($c));
        }
    } else {
        //No se puede añadir porque faltan datos
        echo "Imposible añadir al animador, faltan datos";
    }
}

function animadores2(&$vec)
{
    //listado de todos los animadores
    conectar($c);
    mysqli_select_db($c, "feliz");

    $sql = "SELECT Especialidad FROM animadores";
    $vec = mysqli_query($c, $sql);
}

function consultaespecialidad()
{
    conectar($c);
    mysqli_select_db($c, "feliz");
    $sql = mysqli_query($c, "SELECT Especialidad FROM animadores");

    //Tabla HTML
    echo "<table class='table w-75 m-5 table-light table-bordered border-primary    border='1'> ";
    echo "<tr class='table-danger'>";
    echo "<th>Especialidad</th>";
    echo "</tr>";

    if ($sql) {//registros de la tabla
        while ($registro = mysqli_fetch_row($sql)) {
            echo "<tr>";
            foreach ($registro  as $clave) {
                echo "<td class='table-info'> $clave </td>";
            }
        }
        echo "</table>";
    } else {
        echo "No hay nungún dato.";
    }
    mysqli_close($c);
}

function consultafiestas()
{
    //mostrar fiestas
    if (isset($_POST['dni'])) {
        //hay $_POST['dni']
        $dni = $_POST['dni'];
    } else {
        //Todas las fiestass
        $dni = "%";
    }

    conectar($c);
    mysqli_select_db($c, "feliz");
    $sql = mysqli_query($c, "SELECT * FROM fiesta WHERE idcliente LIKE '$dni'");

    //tabla HTML
    echo "<table class='table w-75 m-5 table-light table-bordered border-primary    border='1'> ";
    echo "<tr class='table-danger'>";
    echo "<th>IDFiesta</th>";
    echo "<th>Fecha</th>";
    echo "<th>Especialidad </th>";
    echo "<th>Duracion</th>";
    echo "<th>Tipo de fiesta</th>";
    echo "<th>Numero</th>";
    echo "<th>Edad Media</th>";
    echo "<th>Importe</th>";
    echo "<th>IdCliente</th>";
    echo "</tr>";

    //Mysqli
    if ($sql) {
        while ($registro = mysqli_fetch_row($sql)) {
            echo "<tr>";
            foreach ($registro  as $clave) {
                echo "<td class='table-info'> $clave </td>";
            }
        }
        echo "</table>";
    } else {
        echo "No Records Found!";
    }
    mysqli_close($c);
}

function altaUsuario()
{
    //Registro de usuarios
    conectar($c);
    mysqli_select_db($c, "feliz");
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contra = $_POST['password'];
    $direccion = $_POST['direccion'];

    //Añadir
    $sql = "INSERT INTO Clientes(NombreCliente, email, Contraseña, direccion) value('$nombre','$email', '$contra', '$direccion')";

    //resultado
    if (mysqli_query($c, $sql)) {
        echo "Cliente añadido";
    } else {
        error($c, mysqli_errno($c));
    }
}

function SoliFiesta()
{
    //pedir fiestas

    //Datos del formulario
    $vec['fecha'] = $_POST["fecha"];
    $animador = $_POST["animador"];
    $vec['animador'] = $_POST['animador'];
    $tiempo = $_POST['duracion'];
    $vec['duracion'] = $_POST['duracion'];
    $vec['tipo'] = $_POST['tipo'];
    $vec['Asistentes'] = $_POST['Asistentes'];
    $vec['edad'] = $_POST['edad'];
    $vec['usuario'] = $_SESSION['nombre'];
    
    //Mysqli
    conectar($c);
    mysqli_select_db($c, "feliz");

    $sql = "SELECT precio FROM animadores where especialidad LIKE '$animador'";

    $result = mysqli_query($c, $sql);

    foreach ($result as $key => $value) {
        $total=$value['precio'] * $tiempo +200;
        echo "<h1>El precio total de la fiesta es de: " . $total . " €</h1>";
        $vec["presupuesto"] = $total;
    }
    //Presupuesto de la fiesta
    $_SESSION['fiesta'] = $vec;

?>
    <form action="../codigo/principal.php?aceptar" method="post">
        <button type="submit" class="btn btn-primary btn-xl rounded-pill mt-5">Aceptar presupuesto</button>
    </form>
<?php

}


function aceptar(){

    //Aceptar presupuesta
    $vec=$_SESSION["fiesta"];

    $fecha=$vec['fecha'];
    $especialidad=$vec['animador'];
    $duracion=$vec['duracion'];
    $tipo=$vec['tipo'];
    $numero=$vec['Asistentes'];
    $edad = $vec['edad'];
    $id=$vec['usuario'];
    $importe = $vec['presupuesto'];

    //Mysqli
    conectar($c);
    mysqli_select_db($c, "feliz");
    
    $sql2="SELECT idcliente FROM clientes WHERE nombreCliente LIKE '$id'";

    if ($vec=mysqli_query($c, $sql2)) {
        foreach ($vec as $key => $value) {
            $id =  $value['idcliente'];
        }
    }

    $sql = "INSERT INTO fiesta(fecha, Especialidad, Duracion, TipoDeFiesta, Numero, EdadMedia, Importe, IdCliente) VALUES('$fecha', '$especialidad', '$duracion', '$tipo', '$numero', '$edad','$importe' , '$id')";

    if (mysqli_query($c, $sql)) {
        echo "Fiesta Añadida";
    }else {
        error($c, mysqli_errno($c));
    }
}