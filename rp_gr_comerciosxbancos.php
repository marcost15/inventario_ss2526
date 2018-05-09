<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './configs/libchart.php';
include './modelo/bd_verificar_privilegios.php';
if (bd_verificar_privilegios('rp_gr_comerciosxbancos.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$c = sql2value("SELECT COUNT(*) FROM bancos");
$bancos = sql2array("SELECT id,nombre FROM bancos");

$total=0;
foreach ($bancos as $i=>$c)
{
$a = $bancos[$i][id];
$bancos[$i][cant] = sql2value("SELECT COUNT(id) FROM comercios_bancos WHERE banco_id = '$a'");
$total = $total	+ $bancos[$i][cant];			
}
foreach ($bancos as $i=>$c)
{
$b = $bancos[$i][cant];
$bancos[$i][porc] = $b*100/$total;
$bancos[$i][porc] = round($bancos[$i]['porc']);
}
$chart = new HorizontalBarChart(700, 600);
$dataSet = new XYDataSet();
foreach ($bancos as $i=>$c)
{
$nombre = $bancos[$i][nombre];
$porc = $bancos[$i][porc];
$cant = $bancos[$i][cant];
$dataSet->addPoint(new Point("$nombre ($cant)", $porc));
}
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 140));
$chart->setTitle("Comercios por Bancos");
$chart->render("./graficos/grcomerciosxbancos.png");

$ss2526->disp();