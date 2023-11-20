<?php session_start(); if (!isset($_SESSION['usuario'])) { ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>My Jeans Store</title>
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
                <img src="imagenes/mujer-jeans-2.jpg" id="imagen2">
            </div>

            <div class="login">
                <div class="caja-login">
                    <div class="caja">
                        <h2>Iniciar Sesión</h2>
                        <form action="controlador/c_entrar.php" method="POST" name="login" style="background:none;">
                            <label for="usuario">Nombre de usuario:</label>
                            <input type="text" name="usuario" id="usuario" autocomplete="off">

                            <div style="margin:5px;"></div>

                            <label for="clave">Contraseña:</label>
                            <input type="password" name="clave" id="clave" autocomplete="off">

                            <div style="margin:15px;"></div>
                            <a href="registrar.php">Registrarse</a>

                            <div style="margin:30px;"></div>

                            <div class="botones">
                                <button type="button" id="iniciar">Iniciar sesión</button>
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

        <script src="javascript/login.js"></script>
    </body>
</html>
<?php } else { header('Location: vista'); } ?>