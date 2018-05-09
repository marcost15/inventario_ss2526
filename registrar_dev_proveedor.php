<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_dev_proveedor.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$persona_id = $_SESSION['usuario']['id'];
$art_dev = sql2array("SELECT serial,arti_id FROM devolucion_articulos WHERE serial <> 0 AND
					status_id = 6 AND funciona = 1");
foreach($art_dev as $i=>$m)
{
		$art = $art_dev[$i]['arti_id'];
        $art_dev[$i]['nombre'] = bd_obt_articulosconcat($art);	
}
$ss2526->assign('datos',$art_dev);
$ss2526->disp();