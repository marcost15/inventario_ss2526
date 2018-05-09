<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_dev_almacen.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$persona_id = $_SESSION['usuario']['id'];
$art_dev = sql2array("SELECT desintalacion_articulos.serial,desintalacion_articulos.arti_id FROM desintalacion_articulos 
					INNER JOIN eventos ON desintalacion_articulos.evento_id = eventos.id 
					WHERE eventos.personal_id = '$persona_id' AND desintalacion_articulos.serial <> '  ' AND
					eventos.tipo = 'DESINSTALACION' AND desintalacion_articulos.status_id = 5");
$art_camb = sql2array("SELECT cambios_articulos.reemplazado AS serial, cambios_articulos.articulo_id AS arti_id
					FROM eventos INNER JOIN cambios_articulos ON cambios_articulos.cambio_id = eventos.id 
					WHERE eventos.personal_id = '$persona_id' AND eventos.tipo = 'CAMBIO' AND 
					cambios_articulos.status_id = 8 AND cambios_articulos.reemplazado <> ' '");
foreach($art_dev as $i=>$m)
{
		$art = $art_dev[$i]['arti_id'];
        $art_dev[$i]['nombre'] = bd_obt_articulosconcat($art);	
}
foreach($art_camb as $i=>$m)
{
		$art1 = $art_camb[$i]['arti_id'];
        $art_camb[$i]['nombre'] = bd_obt_articulosconcat($art1);	
}
$art_devolucion = array_merge($art_dev, $art_camb);
$ss2526->assign('datos',$art_devolucion);
$ss2526->disp();