<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './configs/libchart.php';
include './modelo/bd_verificar_privilegios.php';
if (bd_verificar_privilegios('rp_gr_comerciosxconexion.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$c = sql2value("SELECT COUNT(*) FROM tipos_conexiones");
$conexiones = sql2array("SELECT id,nombre FROM tipos_conexiones");

$total=0;
foreach ($conexiones as $i=>$c)
{
$a = $conexiones[$i][id];
$conexiones[$i][cant] = sql2value("SELECT COUNT(*) FROM comercios WHERE conexion_id = '$a'");
$total = $total	+ $conexiones[$i][cant];			
}
foreach ($conexiones as $i=>$c)
{
$b = $conexiones[$i][cant];
$conexiones[$i][porc] = $b*100/$total;
$conexiones[$i][porc] = number_format($conexiones[$i]['porc'],2,',','.');
}
$chart = new PieChart();
$dataSet = new XYDataSet();
foreach ($conexiones as $i=>$c)
{
$nombre = $conexiones[$i][nombre];
$porc = $conexiones[$i][porc];
$cant = $conexiones[$i][cant];
$dataSet->addPoint(new Point("$nombre ($cant)", $porc));
}
$chart->setDataSet($dataSet);
$chart->setTitle("Comercios por Conexión");
$chart->render("./graficos/grcomerciosxconexion.png");

$ss2526->disp();