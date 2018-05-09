<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_verificar_privilegios.php';
include './modelo/bd_obt_razones.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('razones.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$f1=new dbFormHandler('razones',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->setConnectionResource($link,'razones_devs','mysql');
$f1->borderStart('Agregar/Modificar Razones de Devoluciones');
$f1->textField('Raz&#243;n','nombre',FH_NOT_EMPTY,30,255,"onkeyup=\"razones.nombre.value=razones.nombre.value.toUpperCase();\"");
$f1->setHelpText('nombre','Por Favor Introduzca la Raz&#243;n de devoluci&#243;n');
$f1->submitButton('Continuar','continuar');
$f1->borderStop();
$f1->onSaved('mensaje');

function mensaje($id,$d)
{
    $_SESSION['mensaje']="RAZÓN PROCESADA CORRECTAMENTE";
	ir('razones.php');
}
$ss2526->assign('razones',bd_obt_razones());
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);