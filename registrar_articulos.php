<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_articulo.php';
include './modelo/bd_lista_tipos_articulos.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_articulos.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$serial = array(
  "S"    => 'SI',
  "C"    => 'NO', 	
);

$f1=new FormHandler('articulo',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->borderStart('Agregar Articulo');
$f1->textField('Descripción','descripcion',FH_STRING,30,35,"onkeyup=\"articulo.descripcion.value=articulo.descripcion.value.toUpperCase();\"");
$f1->textField('Marca','marca',FH_STRING,30,35,"onkeyup=\"articulo.marca.value=articulo.marca.value.toUpperCase();\"");
$f1->textField('Modelo','modelo',FH_STRING,30,35,"onkeyup=\"articulo.modelo.value=articulo.modelo.value.toUpperCase();\"");
$f1->selectField("Tipo", "tipo_id",bd_lista_tipos_articulos(),FH_NOT_EMPTY,true);
$f1->radioButton("Serial Obligatorio", "seria_cant", $serial,FH_NOT_EMPTY,true);
$f1->setMask(
   " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%field% %field%</td>\n".
   " </tr>\n"
);
$f1->submitButton('Registrar','registrar');
$f1->resetButton();
$f1->borderStop();
$f1->onCorrect("procesar");

function procesar($d)
{
	bd_guardar_articulos($d);
	$_SESSION['mensaje']="ARTICULO REGISTRADO CORRECTAMENTE";	
	ir('registrar_articulos.php');
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);