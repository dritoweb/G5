<?php
session_start();
include("funciones.php");

if (isset($_GET['loginUsuario'])) {
    loginUsuario($mensaje);
}

// if(isset($_GET['altaUsuario'])){
//     altaUsuario();
// }
if(isset($_GET['cerrarsesion'])){
    cerrarsesion();
 }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>One Page Wonder - Start Bootstrap Template</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <?php
    include("../formularios/header.php");
    ?>
    <header class="masthead text-center text-white">
        <?php
        
        if (isset($mensaje)) {
            echo "$mensaje";
        } elseif (isset($_GET['crearbd'])) {
            crearbd();
        }elseif (isset($_GET['delbd'])) {
            deletebd();
        }elseif (isset($_GET['AltaAnimador'])){
            AltaAnimador();
        }
        if (isset($_GET['consultaespecialidad'])){
            consultaespecialidad();
        }
        if (isset($_GET['consultafiestas'])){
            consultafiestas();
        }elseif (isset($_GET['altaUsuario'])){
            altaUsuario();
        }
        
        
        ?>
    </header>

        <!-- Footer-->
        <footer style="background: linear-gradient(0deg, #ff6a00 0%, #ee0979 100%)" class="py-5 bg-black ">
            <div class="container">
                <p class="m-0 text-center text-white small">Copyright &copy; G5 Website 2021</p>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
</body>

</html>