<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>One Page Wonder - Start Bootstrap Template</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link rel="stylesheet" href="css/style.css"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top d-flex justify-content-center ">
        <div class="container ">
            <a class="navbar-brand" href="#">Piñata Feliz</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse row d-flex justify-content-center " id="navbarResponsive">

                <?php
                if (isset($_SESSION['tipo'])) {
                    if ($_SESSION['tipo'] == "admin") {
                ?>
                        
                        <div class="dropdown">
                            <a class="btn dropdown nav-link text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"  aria-expanded="false">
                                Manejar BD
                            </a>
                            <div class="dropdown-menu">
                                <a class="nav-link" href="codigo/principal.php?crearbd">Crear BD</a>
                                <a class="nav-link" href="codigo/principal.php?delbd">Borar BD</a>
                                <a class="nav-link" href="formularios/altaAnimador.php">Alta Animador</a>
                                <a class="nav-link" href="formularios/bajaAnimador.php">Eliminar Animador</a>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a class="btn dropdown nav-link text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"  aria-expanded="false">
                                Consultas
                            </a>
                            <div class="dropdown-menu">
                                <a class="nav-link" href="codigo/principal.php?consultaespecialidad">Todas las especialidades</a>
                                <a class=" nav-link" href="codigo/principal.php?consultafiestas">Todas las fiestas</a>
                                <a class=" nav-link" href="#">Fiestas por clientes</a>
                            </div>
                        </div>

                    <?php
                    } else {
                        ?>
                            <a class="btn dropdown nav-link text-white" href="formularios/SolicitarFiesta.php">Solicitar Fiesta</a>
                            <a class="btn dropdown nav-link text-white" href="codigo/principal.php?consultarfiesta">Consultar mis fiestas</a>
                        <?php
                    }
                    ?>
                    
                        <a class="btn dropdown nav-link text-white" href="codigo/principal.php?cerrarsesion">Cerrar sesion</a>
                    
                <?php
                } else {
                ?>
                    
                        <a class="btn dropdown nav-link text-white" href="formularios/altaUsuario.php">Registrarse</a>
                        <a class="btn dropdown nav-link text-white" href="formularios/loginUsuario.php">Iniciar Sesion</a>
                <?php
                }
                ?>

            </div>
        </div>
    </nav>
    <header class="masthead text-center text-white">
        
        <div class="masthead-content">
            <div class="container">
                <h1 class="masthead-heading mb-0">One Page Wonder</h1>
                <h2 class="masthead-subheading mb-0">Will Rock Your Socks Off</h2>
                <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#!">Learn More</a>
            </div>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </header>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/01.jpg" alt="..." /></div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">For those about to rock...</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/02.jpg" alt="..." /></div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <h2 class="display-4">We salute you!</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/03.jpg" alt="..." /></div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">Let there be rock!</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-black">
        <div class="container">
            <p class="m-0 text-center text-white small">Copyright &copy; G5 Website 2021</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>