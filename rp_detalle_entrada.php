<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_detalle_entrada.php';
include './modelo/bd_obt_articulosconcat.php';
include './modelo/bd_obt_personal_nombre.php';
include './modelo/bd_obt_proveedores.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_detalle_entrada.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
} 
$id = $_REQUEST['id'];
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT COUNT(*) FROM articulos_entradas WHERE entrada_id = '$id'");
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
$entrada_dt = bd_detalle_entrada($_REQUEST['li'],$id);

$entrada=sql2row("SELECT personal_id,proveedor_id,fecha,observacion FROM entradas WHERE id = '$id' LIMIT 0,1");
$a = $entrada['personal_id'];
$entrada['personal_id'] = bd_obt_personal_nombre($a);
$entrada['fecha'] = f2f($entrada['fecha']);
$b = $entrada['proveedor_id'];
$entrada['proveedor_id'] = bd_obt_proveedor($b);
foreach ($entrada_dt as $i=>$c)
{
	$a = $entrada_dt[$i]['articulo_id'];
	$entrada_dt[$i]['articulo_id'] = bd_obt_articulosconcat($a);
}
$ss2526->assign('n',$n);
$ss2526->assign('id',$id);
$ss2526->assign('indice',$indice);
$ss2526->assign('datos',$entrada_dt);
$ss2526->assign('entrada',$entrada);
$ss2526->disp();