<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_lista_bancos.php';
include './modelo/bd_obt_bancos.php';
include './modelo/bd_ficha_comercios.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_afiliados.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
if(!isset($_REQUEST))
{
    unset($_SESSION['comercio']);
}
switch($_REQUEST['accion'])
{
	case 'eliminar':
		unset($_SESSION['comercio']['datos_bancos'][$_REQUEST['id']]);
		sort($_SESSION['comercio']['datos_bancos']);
		ir('registrar_afiliados.php');
		break;
}
if(isset($_REQUEST['mensaje']))
{
	$_SESSION['mensaje'] = $_REQUEST['mensaje'];
}
$f2=new FormHandler('comercio',NULL,'onclick="highlight(event)"');
$f2->setLanguage('es');
$f2->borderStart('Seleccione el Comercio');
$f2->textField("Codigo","id",FH_STRING,10,6,"onDblClick=\"window.open('ventana_comercios.php','sopa');\"");
$f2->textField("Comercio", "razon_social",FH_STRING,30,255,"onDblClick=\"window.open('ventana_comercios.php','sopa');\"");
$f2->textField("Sucursal","sucursal",_FH_STRING,30,100);
$f2->submitButton('Agregar');
$f2->borderStop();
$f2->onCorrect('proc_datos_comercio');


$f1=new FormHandler('comercio_bancos',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$f1->borderStart('Agregar Afiliados');
$f1->selectField("Banco","banco_id",bd_lista_bancos(),FH_NOT_EMPTY,true);
$f1->textField('Afiliado','afiliado',FH_DIGIT,30,255,"onkeyup=\"comercio_bancos.afiliado.value=comercio_bancos.afiliado.value.toUpperCase();\"");
$f1->submitButton('Agregar');
$f1->borderStop();
$f1->onCorrect('proc_datos_bancos');

function proc_datos_bancos($d)
{
	$enmatriz = false;
	$id = $d['afiliado'];
	$n=sql2value("SELECT COUNT(*) FROM comercios_bancos  WHERE afiliado LIKE '$id'");
	if ($n != 0)
	{
		$enmatriz = true;
		$_SESSION['mensaje'] = "EL AFILIADO YA EXISTE... VERIFIQUE"; 
	}
	if(isset($_SESSION['comercio']['datos_bancos']))
	{
		$bancos1 = $_SESSION['comercio']['datos_bancos'];
		foreach($bancos1 as $i=>$m)
		{
			if($bancos1[$i]['banco_id'] == $d['banco_id'])
			{
				$enmatriz = true;
				$_SESSION['mensaje'] = "EL BANCO YA FUE AFILIADO... VERIFIQUE"; 
				break;
			}
			else
			{
				if($bancos1[$i]['afiliado'] == $d['afiliado'])
				{
					$enmatriz = true;
					$_SESSION['mensaje'] = "EL AFILIADO YA EXISTE... VERIFIQUE"; 
					break;
				}
			}			
		}
	}
    if($enmatriz == false)
    {
	    $d['banco_nombre'] = bd_obt_bancos($d['banco_id']);
		$_SESSION['comercio']['datos_bancos'][]=$d;
    }
    return false;	
}
function proc_datos_comercio($d)
{
	$id2 = $d['id'];
	$f=sql2value("SELECT COUNT(*) FROM comercios  WHERE id LIKE '$id2'");
	if ($f != 0)
	{
		$n=sql2value("SELECT COUNT(*) FROM comercios_bancos  WHERE comercio_id LIKE '$id2'");
		if ($n == 0)
		{
			$_SESSION['comercio']['datos_comercio']=$d;
			return false;
		}
		else
		{
			unset($_SESSION['comercio']);
			$_SESSION['comercio']['datos_comercio'] = bd_ficha_comercios($id2);
			$afi = bd_ficha_afiliados($id2);
			foreach($afi as $i=>$m)
			{
				$afi[$i]['banco_nombre'] = bd_obt_bancos($afi[$i]['banco_id']);
				$_SESSION['comercio']['datos_bancos'][] = $afi[$i];
			}
			$_SESSION['comercio']['estatus'] = 'MODIFICAR';
			$_SESSION['mensaje'] = "EL COMERCIO YA FUE AFILIADO... PRECAUCION PUEDE MODIFICAR LOS AFILIADO"; 
			return false;	
			ir('registrar_afiliados.php');
		}
	}
	else
	{
		$_SESSION['mensaje'] = "EL COMERCIO NO EXISTE....  VERIFIQUE"; 
		return false;	
	}
}
$ss2526->assign('f1',$f1->flush(true));
$ss2526->assign('f2',$f2->flush(true));
$ss2526->assign('items',@count($_SESSION['comercio']['datos_bancos']));
$ss2526->assign('items1',@count($_SESSION['comercio']['datos_comercio']));
$ss2526->disp();
unset($_SESSION['mensaje']);