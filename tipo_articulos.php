<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_obt_tipos_articulos.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('tipo_articulos.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$f1=new dbFormHandler('tipos_articulos',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->setConnectionResource($link,'tipos_articulos','mysql');
$f1->borderStart('Agregar/Modificar Tipos de Articulos');
$f1->textField('Tipo de Articulo','nombre',FH_NOT_EMPTY,30,255,"onkeyup=\"tipos_articulos.nombre.value=tipos_articulos.nombre.value.toUpperCase();\"");
$f1->setHelpText('nombre','Por Favor Introduzca el nombre del Articulo');
$f1->submitButton('Continuar','continuar');
$f1->borderStop();
$f1->onSaved('mensaje');

function mensaje($id,$d)
{
    $_SESSION['mensaje']="TIPO DE ARTICULO PROCESADO CORRECTAMENTE";
	ir('tipo_articulos.php');
}
$ss2526->assign('articulos',bd_obt_tipos_articulos());
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);