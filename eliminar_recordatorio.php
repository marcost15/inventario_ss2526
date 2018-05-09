<?php
session_start();
include './configs/funciones.php';
include './configs/bd.php';
include './modelo/bd_eliminar_recordatorios.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('eliminar_recordatorio.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
bd_eliminar_recordatorios($_REQUEST['id']);
ir('principal.php');