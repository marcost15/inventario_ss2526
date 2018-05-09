<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './modelo/bd_buscar_recordatorio.php';
include './modelo/bd_obt_personal_nombre.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('principal.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$recordatorios = bd_buscar_recordatorio($_SESSION['usuario']['id']);
$personal_id = $_SESSION['usuario']['id'];
$a = sql2value("SELECT nivel_id FROM personal WHERE id = '$personal_id'");
foreach ($recordatorios as $i=>$c)
{
	$recordatorios[$i]['fecha'] = f2f($recordatorios[$i]['fecha']);
	$recordatorios[$i]['nombre'] = bd_obt_personal_nombre($recordatorios[$i]['personal_id']);
	if ($recordatorios[$i]['personal_id'] == $_SESSION['usuario']['id'])
	{
		$recordatorios[$i]['permiso'] = 1;
	}
	else
	{
		if ($a == 1)
		{
			$recordatorios[$i]['permiso'] = 1;
		}
	}
}
$ss2526->assign('lista',$recordatorios);
$ss2526->disp();