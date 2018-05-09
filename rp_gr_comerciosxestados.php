<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './configs/libchart.php';
include './modelo/bd_verificar_privilegios.php';
if (bd_verificar_privilegios('rp_gr_comerciosxestados.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$c = sql2value("SELECT COUNT(*) FROM estados");
$estados = sql2array("SELECT id,nombre FROM estados");

$total=0;
foreach ($estados as $i=>$c)
{
$a = $estados[$i][id];
$estados[$i][cant] = sql2value("SELECT Count(comercios.id) FROM comercios INNER JOIN ciudades ON 
								ciudades.id = comercios.ciudad_id INNER JOIN estados ON ciudades.estado_id = estados.id
								GROUP BY estados.id HAVING estados.id = '$a'");
$total = $total	+ $estados[$i][cant];			
}
foreach ($estados as $i=>$c)
{
$b = $estados[$i][cant];
$estados[$i][porc] = $b*100/$total;
$estados[$i][porc] = round($estados[$i]['porc']);
}
$chart = new HorizontalBarChart(700, 600);
$dataSet = new XYDataSet();
foreach ($estados as $i=>$c)
{
$nombre = $estados[$i][nombre];
$porc = $estados[$i][porc];
$cant = $estados[$i][cant];
$dataSet->addPoint(new Point("$nombre ($cant)", $porc));
}
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 140));
$chart->setTitle("Comercios por Estado");
$chart->render("./graficos/grcomerciosxestados.png");

$ss2526->disp();