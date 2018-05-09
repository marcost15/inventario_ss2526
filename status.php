<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_obt_status.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('status.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$f1=new dbFormHandler('status',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->setConnectionResource($link,'status_articulos','mysql');
$f1->borderStart('Agregar/Modificar Status de Articulos');
$f1->textField('Status','nombre',FH_NOT_EMPTY,30,255,"onkeyup=\"status.nombre.value=status.nombre.value.toUpperCase();\"");
$f1->setHelpText('nombre','Por Favor Introduzca el posible Status de equipos');
$f1->submitButton('Continuar','continuar');
$f1->borderStop();
$f1->onSaved('mensaje');

function mensaje($id,$d)
{
    $_SESSION['mensaje']="STATUS PROCESADO CORRECTAMENTE";
	ir('status.php');
}
$ss2526->assign('status',bd_obt_status());
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);