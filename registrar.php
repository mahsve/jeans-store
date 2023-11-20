<?php session_start(); if (!isset($_SESSION['usuario'])) { ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Registrarse - My Jeans Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="imagenes/favicon.png" type="image/png" />
        <link rel="stylesheet" href="css/estilos.css">
        <script src="javascript/jquery-3.3.1.js"></script>
        <script src="javascript/sweetalert.min.js"></script>
    </head>

    <body>
        <header>
            <h1><a href="index.php">My Jeans Store</a></h1>
        </header>

        <div class="wrapper">
            <div class="modelo">
                <img src="imagenes/mujer-jeans.jpg" id="imagen2">
            </div>

            <div class="login">
                <div class="caja-login">
                    <div class="caja">
                        <h2>Registrarse</h2>
                        <form action="controlador/c_registrar.php" method="POST" name="registro" style="background:none;">
                            <label for="usuario">Nombre de usuario:</label>
                            <input type="text" name="usuario" id="usuario" autocomplete="off">

                            <div style="margin:5px;"></div>

                            <label for="clave1">Contraseña:</label>
                            <input type="password" name="clave1" id="clave1" autocomplete="off">

                            <div style="margin:5px;"></div>

                            <label for="clave2">Repita contraseña:</label>
                            <input type="password" name="clave2" id="clave2" autocomplete="off">

                            <div style="margin:30px;"></div>

                            <input type="hidden" name="opcion" id="opcion">
                            <div class="botones">
                                <button type="button" id="registrar">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer>Todos los derechos reservados &copy; My Jeans Store 2018</footer>

        <?php if (isset($_GET['mensaje'])) { ?>
            <div id="mensaje" mensaje="<?php echo $_GET['mensaje']; ?>"></div>
        <?php } ?>

        <script src="javascript/registrar.js"></script>
    </body>
</html>
<?php } else { header('Location: vista'); } ?>