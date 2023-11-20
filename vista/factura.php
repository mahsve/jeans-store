<?php session_start(); if (isset($_SESSION['usuario'])) {
    include_once '../modelo/m_factura.php';
    $factura = new Factura();
    $numeroFactura = $factura->consultarUltimaFactura();

    include_once '../modelo/m_principal.php';
    $principal = new Principal();
    $exitencia = $principal->Existencia();
    ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Gestionar Factura - My Jeans Store</title>
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
                <form action="../controlador/c_factura.php" method="post" class="transaccion" name="formulario">
                    <h2>Facturar ventas</h2>

                    <div class="divisores" style="width:29%;">                    
                        <label for="numero">Numero de factura:</label>
                        <input type="text" name="numero" id="numero" value="<?php if (isset($_GET['numero'])) { echo $_GET['numero']; } else { echo $numeroFactura; } ?>" autocomplete="off" style="text-align:right;">
                    </div>
                    <div style="margin:20px;"></div>
                
                    <label><i>Datos del cliente (Si no esta registrado se registra automaticamente).</i></label>
                    <div style="margin:10px;"></div>

                    <div class="divisores" style="width:29%;">                    
                        <label for="cedula">Cedula:</label>
                        <input type="text" name="cedula" id="cedula" value="<?php if (isset($_GET['cedula'])) { echo $_GET['cedula']; } ?>" autocomplete="off">
                    </div>

                    <div class="divisores" style="width:50%;">
                        <label for="nombre">Nombre completo:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php if (isset($_GET['nombre'])) { echo $_GET['nombre']; } ?>" autocomplete="off">
                    </div>

                    <div class="divisores" style="width:20%;">
                        <button type="button" id="buscar" style="width:100%;">Buscar</button>
                    </div>

                    <label for="direccion">Dirección:</label>
                    <textarea name="direccion" id="direccion" autocomplete="off"><?php if (isset($_GET['direccion'])) { echo $_GET['direccion']; } ?></textarea>

                    <div style="margin:10px;"></div>

                    <label><i>Compra Jeans</i>. Existencia <?php echo $exitencia; ?> (La cantidad no debe sobre pasar la existencia).</label>
                    <div style="margin:10px;"></div>
                
                    <div class="divisores" style="width:20%;">
                        <label for="cantidad">Cantidad:</label>
                        <input type="text" name="cantidad" id="cantidad" value="<?php if (isset($_GET['cantidad'])) { echo $_GET['cantidad']; } ?>" autocomplete="off" style="text-align:right;">
                    </div>
                    <div class="divisores" style="width:20%;">
                        <label for="precio">Precio:</label>
                        <input type="text" name="precio" id="precio" value="<?php if (isset($_GET['precio'])) { echo $_GET['precio']; } ?>" autocomplete="off" style="text-align:right;">
                    </div>
                    <div class="divisores" style="width:20%;">
                        <label for="subtotal">Sub-total:</label>
                        <input type="text" name="subtotal" id="subtotal" class="readonly" value="<?php if (isset($_GET['subtotal'])) { echo $_GET['subtotal']; } ?>" autocomplete="off" style="text-align:right;" readonly>
                    </div>
                    <div class="divisores" style="width:20%;">
                        <label for="descuento">Descuento %:</label>
                        <input type="text" name="descuento" id="descuento" class="readonly" value="<?php if (isset($_GET['descuento'])) { echo $_GET['descuento']; } ?>" autocomplete="off" style="text-align:right;" readonly>
                    </div>
                    <div class="divisores" style="width:18%;">
                        <label for="total">Total a pagar:</label>
                        <input type="text" name="total" id="total" class="readonly" value="<?php if (isset($_GET['total'])) { echo $_GET['total']; } ?>" autocomplete="off" style="text-align:right;" readonly>
                    </div>

                    <div style="margin:30px;"></div>
                    <input type="hidden" name="opcion" id="opcion">
                    <input type="hidden" name="estatus" id="estatus" value="<?php if (isset($_GET['estatus'])) { echo $_GET['estatus']; } ?>">

                    <div class="botones">
                        <button type="button" id="registrar" <?php if (isset($_GET['estatus'])) { echo "style='display:none;'";} ?>>Registrar</button>
                        <button type="button" id="consultar">Consultar</button>
                        <?php if (isset($_GET['estatus'])) { if ($_GET['estatus'] == 'A') {?>
                            <button type="button" id="cancelar">Cancelar</button>
                        <?php } } ?>
                        <button type="button" id="limpiar">X</button>
                    </div>
                </form>
            </div>
        </div>

        <footer>Todos los derechos reservados &copy; My Jeans Store 2018</footer>

        <?php if (isset($_GET['mensaje'])) { ?>
            <div id="mensaje" mensaje="<?php echo $_GET['mensaje']; ?>"></div>
        <?php } ?>

        <script src="../javascript/factura.js"></script>
    </body>
</html>
<?php } else { header('Location: ../index.php?mensaje=inicie_sesion'); } ?>