<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_buscar_entradas.php';
include './modelo/bd_obt_personal_nombre.php';
include './modelo/bd_obt_depositos.php';
include './modelo/bd_obt_proveedores.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_cons_entrada.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
} 
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT COUNT(*) FROM entradas");
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
$entradas = bd_buscar_entradas($_REQUEST['li']);
foreach ($entradas as $i=>$c)
{
	$a = $entradas[$i]['personal_id'];
	$entradas[$i]['personal_id'] = bd_obt_personal_nombre($a);
	$b = $entradas[$i]['deposito_id'];
	$entradas[$i]['deposito_id'] = bd_obt_depositos($b);
	$c = $entradas[$i]['proveedor_id'];
	$entradas[$i]['proveedor_id'] = bd_obt_proveedor($c);
	$entradas[$i]['fecha'] = f2f($entradas[$i]['fecha']);
}
$ss2526->assign('n',$n);
$ss2526->assign('indice',$indice);
$ss2526->assign('datos',$entradas);
$ss2526->assign('fondoreporte',1);
$ss2526->disp();