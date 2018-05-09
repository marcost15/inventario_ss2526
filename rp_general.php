<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_lista_articulos.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_general.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$articulos1 = bd_lista_articulos();
foreach($articulos1 as $i=>$m)
{
	$articulos[$i] = $articulos1[$i];
}

$articulos = bd_obt_articulosconcat();
foreach ($articulos as $i=>$c)
{
$a = $articulos[$i][id];
$art[$i][consta] = 0;
$articulos[$i][alm] = sql2value("SELECT sum(cantidad) FROM articulos_entradas
									WHERE articulo_id = '$a' AND estatus_id = '1'");

$articulos[$i][asig] = sql2value("SELECT sum(cantidad) FROM asignacion_articulos
									WHERE articulo_id = '$a' AND estatus_id = '8'");
									
$articulos[$i][inst1] = sql2value("SELECT SUM(instalacion_articulos.cantidad) FROM asignacion_articulos INNER JOIN 
									instalacion_articulos ON instalacion_articulos.asigart_id = asignacion_articulos.id
									WHERE asignacion_articulos.articulo_id = '$a' AND instalacion_articulos.tipo = 'EQUIPO'");
									
$articulos[$i][inst2] = sql2value("SELECT SUM(cantidad) FROM instalacion_articulos 
									WHERE asigart_id = '$a' AND instalacion_articulos.tipo = 'ACCESORIO'");
$articulos[$i][inst] = $articulos[$i][inst1] + $articulos[$i][inst2];
															
$articulos[$i][camb] = sql2value("SELECT SUM(cantidad) FROM cambios_articulos
									WHERE articulo_id = '$a'");
									
$articulos[$i][desinst] = sql2value("SELECT SUM(cantidad) FROM desintalacion_articulos
									WHERE arti_id = '$a'");

$articulos[$i][entregados] = sql2value("SELECT sum(cantidad) FROM devolucion_articulos
									WHERE arti_id = '$a' AND status_id = '7'");

$articulos[$i][total] =	$articulos[$i][alm] + $articulos[$i][asig] + $articulos[$i][inst] + $articulos[$i][camb] + $articulos[$i][desinst] + $articulos[$i][entregados];

$totalalm = $totalalm	+ $articulos[$i][alm];
$totalasig = $totalasig	+ $articulos[$i][asig];
$totalinst = $totalinst	+ $articulos[$i][inst];
$totalcamb = $totalcamb	+ $articulos[$i][camb];	
$totalentregados = $totalentregados	+ $articulos[$i][entregados];
$totaldesint = $totaldesint + $articulos[$i][desinst];	 		
$totaltotal = $totaltotal + $articulos[$i][total];	 		
}
$fondoreporte = 1;
$ss2526->assign('totalalm',$totalalm);
$ss2526->assign('totalasig',$totalasig);
$ss2526->assign('totalinst',$totalinst);
$ss2526->assign('totalcamb',$totalcamb);
$ss2526->assign('totaldesint',$totaldesint);
$ss2526->assign('totalentregados',$totalentregados);
$ss2526->assign('totaltotal',$totaltotal);
$ss2526->assign('datos',$articulos);
$ss2526->assign('fondoreporte',$fondoreporte);
$ss2526->disp();