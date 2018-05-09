<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_detalle_eventos.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_obt_personal_nombre.php';
include './modelo/bd_obt_comercios.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_detalle_eventos.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
} 
$id = $_REQUEST['id'];
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$tipo=sql2value("SELECT tipo FROM eventos WHERE id = '$id'");
if ($tipo === 'INSTALACION')
{
	$n=sql2value("SELECT COUNT(*) FROM instalacion_articulos WHERE instalacion_id = '$id'");
	$eventos_dt = bd_detalle_instalacion($_REQUEST['li'],$id);
}
if ($tipo === 'CAMBIO')
{
	$n=sql2value("SELECT COUNT(*) FROM cambios_articulos WHERE cambio_id = '$id'");
	$eventos_dt = bd_detalle_cambio($_REQUEST['li'],$id);
}
if ($tipo === 'DESINSTALACION')
{
	$n=sql2value("SELECT COUNT(*) FROM desintalacion_articulos WHERE evento_id = '$id'");
	$eventos_dt = bd_detalle_desinstalacion($_REQUEST['li'],$id);
}
$indice=array();
$li=0;
while($li<$n)
{
	$ls=$li+$delta-1;
	if($ls>$n)
	{
		$ls=$n;
	}
	$indice[]=array('li'=>$li,'ls'=>$ls);
	$li=$ls+1;
}
$eventos=sql2row("SELECT tipo,fecha_e,personal_id,comercio_id,fecha,observacion FROM eventos WHERE id = '$id' LIMIT 0,1");
$a = $eventos['personal_id'];
$eventos['personal_id'] = bd_obt_personal_nombre($a);
$c = $eventos['comercio_id'];
$eventos['comercio_id'] = bd_obt_comercios($c);
$afiliado = sql2value("SELECT comercios_bancos.afiliado FROM comercios INNER JOIN comercios_bancos ON 
					   comercios_bancos.comercio_id = comercios.id AND comercios_bancos.banco_id = comercios.banco_id
					   WHERE comercios.id = '$id' LIMIT 0,1");
$eventos['fecha'] = f2f($eventos['fecha']);
$eventos['fecha_e'] = f2f($eventos['fecha_e']);

foreach ($eventos_dt as $i=>$c)
{
	$a = $eventos_dt[$i]['articulo_id'];
	$eventos_dt[$i]['articulo_id'] = bd_obt_articulosconcat($a);
}
$ss2526->assign('n',$n);
$ss2526->assign('id',$id);
$ss2526->assign('indice',$indice);
$ss2526->assign('datos',$eventos_dt);
$ss2526->assign('eventos',$eventos);
$ss2526->assign('afiliado',$afiliado);
$ss2526->assign('tipo',$tipo);
$ss2526->disp();