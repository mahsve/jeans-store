<?php session_start(); if (isset($_SESSION['usuario'])) {
    include_once '../modelo/m_principal.php';
    $principal = new Principal();
    $exitencia = $principal->Existencia();
    ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Gestionar cliente - My Jeans Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="../imagenes/favicon.png" type="image/png" />
        <link rel="stylesheet" href="../css/estilos.css">
        <script src="../javascript/jquery-3.3.1.js"></script>
        <script src="../javascript/sweetalert.min.js"></script>
    </head>

    <body>
        <header>
            <h1><a href="../vista">My Jeans Store</a></h1>
        </header>

        <div class="wrapper2">
            <nav id="menu">
                <ul id="nav">
                    <li><a href="../vista">Inicio</a></li>
                    <li><a>Clientes</a>
                        <ul>
                            <li><a href="cliente.php">Gestionar cliente</a></li>
                        </ul>
                    </li>
                    <li><a>Ventas</a>
                        <ul>
                            <li><a href="factura.php">Facturar venta</a></li>
                        </ul>
                    </li>
                    <li><a>Reportes</a>
                        <ul>
                            <li><a href="reporte_cliente.php">Clientes</a></li>
                            <li><a href="reporte_factura.php">Facturas</a></li>
                        </ul>
                    </li>
                    <li><a href="../controlador/c_salir.php">salir</a></li>
                </ul>
            </nav>

            <div class="content">
                <form action="../controlador/c_producto.php" method="post" class="maestro" name="formulario">
                    <h2>Agregar Jeans</h2>
                
                    <label>Existencia: <?php echo $exitencia; ?></label>

                    <label for="cantidad">Cantidad a ingresar:</label>
                    <input type="text" name="cantidad" id="cantidad" autocomplete="off">

                    <div style="margin:30px;"></div>

                    <input type="hidden" name="opcion" id="opcion">
                    <div class="botones">
                        <button type="button" id="agregar">Agregar al inventario</button>
                    </div>
                </form>
            </div>
        </div>

        <footer>Todos los derechos reservados &copy; My Jeans Store 2018</footer>

        <?php if (isset($_GET['mensaje'])) { ?>
            <div id="mensaje" mensaje="<?php echo $_GET['mensaje']; ?>"></div>
        <?php } ?>

        <script src="../javascript/agregar.js"></script>
    </body>
</html>
<?php } else { header('Location: ../index.php?mensaje=inicie_sesion'); } ?>