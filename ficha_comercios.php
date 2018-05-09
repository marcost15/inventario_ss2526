<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_ficha_comercios.php';
include './modelo/bd_obt_ciudades.php';
include './modelo/bd_obt_tipos_conexiones.php';
include './modelo/bd_obt_bancos.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('ficha_comercios.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$comercio = bd_ficha_comercios($_REQUEST['id']);
$afiliado = bd_ficha_afiliados($_REQUEST['id']);
$comercio['estado_nombre'] = sql2value("SELECT estados.nombre FROM ciudades INNER JOIN estados ON 
								ciudades.estado_id = estados.id 
								WHERE ciudades.id = '$comercio[ciudad_id]'");
$comercio['ciudad_id']= bd_obt_ciudades($comercio['ciudad_id']);
$comercio['conexion_id']= bd_obt_tipos_conexiones($comercio['conexion_id']);
$comercio['banco_id']= bd_obt_bancos($comercio['banco_id']);
foreach($afiliado as $i=>$m)
{
	$afiliado[$i]['banco_nombre'] = bd_obt_bancos($afiliado[$i]['banco_id']);
}
$ss2526->assign('comercio',$comercio);
$ss2526->assign('afiliado',$afiliado);
$ss2526->disp();