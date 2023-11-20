<?php session_start(); if (isset($_SESSION['usuario'])) {
    include_once '../modelo/m_principal.php';
    $principal = new Principal();
    $clientes = $principal->Clientes();
    $facturas = $principal->Facturas();
    $exitencia = $principal->Existencia();
    $ultimasFacturas = $principal->consultarFacturas();
    ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Inicio - My Jeans Store</title>
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
                <div class="box-information">
                    <div class="information">
                        <h2>
                            <div class="title">
                                Clientes
                            </div>
                            <div class="number" style="background: green;">
                                <?php echo $clientes;?>
                            </div>
                        </h2>
                    </div>

                    <div class="information">
                        <h2>
                            <div class="title">
                                Ventas
                            </div>
                            <div class="number" style="background: orange;">
                                <?php echo $facturas;?>
                            </div>
                        </h2>
                    </div>

                    <div class="information">
                        <h2>
                            <div class="title">
                                Existencia
                            </div>
                            <div class="number" style="background: grey;">
                                <?php echo $exitencia;?>
                            </div>
                            <div>
                                <a href="agregar.php">Agregar</a>
                            </div>
                        </h2>
                    </div>
                </div>

                <div class="ultimas">
                    <h2>Ultimas 10 ventas:</h2>
                    <hr>
                    <?php if ($ultimasFacturas){ ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Número</th>
                                    <th>Cedula</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Sub-Total</th>
                                    <th>Descuento</th>
                                    <th>Total</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ultimasFacturas as $factura) { ?>
                                <?php 
                                    $cantidad = $factura[2];
                                    $precio = $factura[4];
                                    $descuento = $factura[5];
                            
                                    $monto = $cantidad*$precio;
                                    $totaldescuento = $monto*$descuento/100;
                            
                                    $total = $monto-$totaldescuento;

                                    if ($factura[6] == 'A') {
                                        $estatus = 'Aprobado';
                                    } else {
                                        $estatus = 'Cancelado';
                                    }
                                ?>
                                <tr>
                                    <td><?php echo $factura[0]; ?></td>
                                    <td><?php echo $factura[7]; ?></td>
                                    <td><?php echo $factura[8]; ?></td>
                                    <td><?php echo $factura[2]; ?></td>
                                    <td><?php echo $factura[4]; ?></td>
                                    <td><?php echo $monto; ?></td>
                                    <td><?php echo $factura[5]; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $estatus; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { echo "Sin Ventas"; } ?>
                </div>
            </div>
        </div>

        <footer>Todos los derechos reservados &copy; My Jeans Store 2018</footer>

        <?php if (isset($_GET['mensaje'])) { ?>
            <div id="mensaje" mensaje="<?php echo $_GET['mensaje']; ?>"></div>
        <?php } ?>
    </body>
</html>
<?php } else { header('Location: ../index.php?mensaje=inicie_sesion'); } ?>