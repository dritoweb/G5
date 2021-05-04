<?php

function login()
{

    $nombre = $_POST['nombre'];
    $contra = $_POST['contra'];

    $conn = mysqli_connect("localhost", "adminapp", "123", "bd_tragaperras");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $resultado = mysqli_query($conn, "SELECT Nombre FROM usuarios");
    if ($nombre == "adminapp" && $contra == "123") {
        $_SESSION['admin'] = "$nombre";
    } else {

        while ($registro = mysqli_fetch_row($resultado)) {

            foreach ($registro  as $clave) {
                if ($nombre == $clave) {
                    $_SESSION['usua'] = "$nombre";
                    if ($clave == ) {
                        # code...
                    }
                }
            }
        }


        header("Refresh:1; url= ../index.php?administrador");
    }
}

function cerrarsesion()
{

    session_destroy();
    header("Refresh:1; url= ../index.php?administrador");
}

function altabd()
{

    $nombre = $_POST["nombre"];
    $contra = $_POST["contra"];
    $edad = $_POST["edad"];
    $sexo = $_POST["sexo"];

    $conn = mysqli_connect("localhost", "adminapp", "123", "bd_tragaperras");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO usuarios (NomUsu, PassworUsu, Edad, Sexo, Puntos)
    VALUES ('$nombre', '$contra', '$edad' ,'$sexo','0')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Refresh:1; url= ../formularios/datos.php");
}

function bajabd()
{

    $nombre = $_SESSION['usua'];

    $conn = mysqli_connect("localhost", "adminapp", "123", "bd_tragaperras");
    $id = mysqli_query($conn, "SELECT IdUsu FROM usuarios WHERE NomUsu = '$nombre'");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

        if ($delete = mysqli_query($conn, "DELETE FROM usuarios WHERE IdUsu = '$id' and NomUsu like '$nombre'")) {
            echo "$nombre se ha eliminado de la base";
            header("Refresh:1; url= ../index.php");
        } else {
            echo "No se ha podido dar de baja, compruebe los datos e intentelo de nuevo";
        }
        echo $id;
    mysqli_close($conn);
    //header("Refresh:1; url= ../index.php");
}
?>