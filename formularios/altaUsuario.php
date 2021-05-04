<?php
session_start();
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
    include("header.php");
    ?>
    <header class="masthead text-center text-white">
        <div class="masthead-content">
            <div class="container d-flex  flex-wrap justify-content-around ">
                <h2 class="masthead-subheading mb-5 col-12 ">Registro</h2>
                <form class="col-4" action="../codigo/principal.php?altaUsuario" method="POST">
                    <div class="">
                        <label for="exampleInputEmail1" class="form-label">Nombre Cliente</label>
                        <input type="nombre" name="nombre" class="form-control" id="nombre-cliente" placeholder="Indiana Jones" aria-describedby="nombre-cliente">
                    </div>
                    <div class="">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="usuario@gmail.com" aria-describedby="emailHelp">
                    </div>
                    <div class="">
                        <label for="exampleInputEmail1" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="123-A" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Direccion</label>
                        <input type="direccion" name="direccion" class="form-control" id="direccion" placeholder="C/Porcino Nº 5" aria-describedby="direccion">
                    </div>
                    <button type="submit" class="btn btn-primary btn-xl rounded-pill mt-5">Enviar</button>
                </form>
            </div>
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