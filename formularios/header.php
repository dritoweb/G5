<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="../">Piñata Feliz</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <?php
            if (isset($_SESSION['tipo'])) {
                if ($_SESSION['tipo'] == "admin") {
            ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="../">Crear BD</a></li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="../">Borar BD</a></li>
                    </ul>
                    <div class="dropdown">
                            <a class="btn dropdown nav-link text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"  aria-expanded="false">
                                Consultas
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item nav-link" href="../codigo/principal.php?consultaespecialidad">Todas las especialidades</a>
                                <a class="dropdown-item nav-link" href="../codigo/principal.php?consultafiestas">Todas las fiestas</a>
                                <a class="dropdown-item nav-link" href="../formularios/fiestaUsuario.php">Fiestas por clientes</a>
                            </div>
                    </div>

                <?php
                } else {
                    echo "Usuario";
                }
                ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="../">Cerrar sesion</a></li>
                </ul>
            <?php
            } else {
            ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="../formularios/loginUsuario.php">SIGN UP</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="../formularios/altaUsuario.php">LOG IN</a></li>
                </ul>
            <?php
            }
            ?>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="../">Volver</a></li>
            </ul>
        </div>
    </div>
</nav>