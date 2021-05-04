<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="../index.html">Piñata Feliz</a>
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