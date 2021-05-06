<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="../">Piñata Feliz</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse  row d-flex justify-content-center" id="navbarResponsive">

            <?php
            if (isset($_SESSION['tipo'])) {
                if ($_SESSION['tipo'] == "admin") {
            ?>
                    <div class="dropdown">
                            <a class="btn dropdown nav-link text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"  aria-expanded="false">
                                Manejar BD
                            </a>
                            <div class="dropdown-menu">
                                <a class="nav-link" href="../codigo/principal.php?crearbd">Crear BD</a>
                                <a class="nav-link" href="../codigo/principal.php?delbd">Borar BD</a>
                                <a class="nav-link" href="../formularios/altaAnimador.php">Alta Animador</a>
                                <a class="nav-link" href="../formularios/bajaAnimador.php">Eliminar Animador</a>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a class="btn dropdown nav-link text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"  aria-expanded="false">
                                Consultas
                            </a>
                            <div class="dropdown-menu">
                                <a class="nav-link" href="../codigo/principal.php?consultaespecialidad">Todas las especialidades</a>
                                <a class=" nav-link" href="../codigo/principal.php?consultafiestas">Todas las fiestas</a>
                                <a class=" nav-link" href="#">Fiestas por clientes</a>
                            </div>
                        </div>

                <?php
                } else {
                    ?>
                            <a class="btn dropdown nav-link text-white" href="../formularios/SolicitarFiesta.php">Solicitar Fiesta</a>
                            <a class="btn dropdown nav-link text-white" href="../codigo/principal.php?consultarfiesta">Consultar mis fiestas</a>
                    <?php
                }
                ?>
                <a class="btn dropdown nav-link text-white" href="../codigo/principal.php?cerrarsesion">Cerrar sesion</a>
            <?php
            } else {
            ?>
                <a class="btn dropdown nav-link text-white" href="../formularios/altaUsuario.php">Registrarse</a>
                <a class="btn dropdown nav-link text-white" href="../formularios/loginUsuario.php">Iniciar Sesion</a>
            <?php
            }
            ?>

                <a class="btn dropdown nav-link text-white" href="../">Volver</a>
        </div>
    </div>
</nav>