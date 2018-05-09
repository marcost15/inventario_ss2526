<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_lista_personal_activo.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_frm_equiposxtec.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$f1=new dbFormHandler('personal');
$f1->borderStart('Personal');
$f1->selectField('Personal', 'id', bd_lista_personal_activo(),FH_NOT_EMPTY,true);

$f1->setMask(
   " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%field% %field%</td>\n".
   " </tr>\n"
);
$f1->submitButton('Aceptar','Aceptar');
$f1->borderStop();
$f1->onCorrect("procesar");

function procesar($d)
{
	$id = $d['id'];
	ir("rp_cons_equiposxtec.php?id=$id");
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->disp();
unset($_SESSION['mensaje']);
