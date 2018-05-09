<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_buscar_devoluciones.php';
include './modelo/bd_obt_personal_nombre.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_cons_devoluciones.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
} 
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT COUNT(*) FROM devoluciones");
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
$devoluciones = bd_buscar_devoluciones($_REQUEST['li']);
foreach ($devoluciones as $i=>$c)
{
	$a = $devoluciones[$i]['personal_id'];
	$devoluciones[$i]['personal_id'] = bd_obt_personal_nombre($a);
	$devoluciones[$i]['fecha'] = f2f($devoluciones[$i]['fecha']);
}
$ss2526->assign('n',$n);
$ss2526->assign('indice',$indice);
$ss2526->assign('datos',$devoluciones);
$ss2526->disp();