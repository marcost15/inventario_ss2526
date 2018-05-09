<?php
include 'krumo.php';
function bs2cts($monto)
{
    return round($monto*100,0);
}

function cts2bs($monto)
{
    return round($monto/100,2);
}

function dinero($string){
   $sep='.';
   $partes=explode('.',$string);

   //Trabajando la parte decimal
   if(count($partes)==1){
      $partes[1]='00';
   }
   if(strlen($partes[1])<2){
      $partes[1]=substr(trim($partes[1].'00'),0,2);
   }
   //trabajando la parte entera

   $s1=strrev($partes[0]);
   $s2='';
   while(strlen($s1)>3){
      $s3=substr($s1,0,3);
      $s2.=$s3.$sep;
      $s1=substr($s1,3);
   }
   $partes[0]=strrev($s2.$s1);
   $string2=join(',',$partes);
   return ($string2);
}

function fecha_larga($fecha){
   $f=explode('-',$fecha);
   $meses=array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo',
   '04'=>'Abril','05'=>'Mayo','06'=>'Junio',
   '07'=>'Julio','08'=>'Agosto','09'=>'Septiembre',
   '10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
   return $f[2].' de '.$meses[$f[1]].' de '.$f[0];
}

function validafecha($fecha)//Cambio en la validacion por marcos
{
	if ($fecha == NULL)
	{
		return 'Ingrese Fecha';
	}
	else
	{
		$fecha=explode('-',$fecha);
		$d = count($fecha);
		if ($d == 3)
		{
			$hoy=date('Y-m-d');
			$hoy=explode('-',$hoy);
			$hoy=$hoy[0]*10000+$hoy[1]*100+$hoy[2];
			$fecha=$fecha[2]*10000+$fecha[1]*100+$fecha[0];			
		}
		else
		{
			$hoy=date('Y-m');
			$hoy=explode('-',$hoy);
			$hoy=$hoy[0]*10000+$hoy[1]*100;
			$fecha=$fecha[1]*10000+$fecha[0]*100;
		}	
		if ($hoy<$fecha)
		{
			return 'Revise la fecha';
		}
		return true;
	}
}
function _validafecha($fecha)
{
	if ($fecha == NULL)
	{
		return true;
	}
	else
	{
		$fecha=explode('-',$fecha);
		$d = count($fecha);
		if ($d <> 2)
		{
			$hoy=date('Y-m-d');
			$hoy=explode('-',$hoy);
			$hoy=$hoy[0]*10000+$hoy[1]*100+$hoy[2];
			$fecha=$fecha[2]*10000+$fecha[1]*100+$fecha[0];			
		}
		else
		{
			$hoy=date('Y-m');
			$hoy=explode('-',$hoy);
			$hoy=$hoy[0]*10000+$hoy[1]*100;
			$fecha=$fecha[1]*10000+$fecha[0]*100;
		}	
		if ($hoy<$fecha)
		{
			return 'Revise la fecha';
		}
		return true;
	}
} //Cambio en la validacion por marcos

function comparafecha($fechad,$fechah) //marcos con un poquito de inteligencia   jajjajajajaja
{
	$fechad=explode('-',$fechad);
	$fechah=explode('-',$fechah);
	$desde = count($fechad);
	$hasta = count($fechah);
	if ($desde AND $hasta === 3)
	{
		$fechad=$fechad[2]*10000+$fechad[1]*100+$fechad[0];
		$fechah=$fechah[2]*10000+$fechah[1]*100+$fechah[0];
		if ($fechad > $fechah)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}//marcos con un poquito de inteligencia   jajjajajajaja

function f2f($fecha){
   $f=explode('-',$fecha);
   return $f[2].'-'.$f[1].'-'.$f[0];
}

function sesion(){
   if (!$_SESSION['nombre']){
      echo "
<html>
<head></head>
<body>
<div style=\"\">
Lo siento. No est&#225;s autorizado para ingresar aqu&#237;
<a href=\"login.php\">Continuar</a>
</div>
</body>
</html>
      ";
      return false;
   }else{
      return true;
   }
}

function ir($direccion){
  header("Location: $direccion");
  exit();
}
///////
function ver2($matriz) {
   $estilo='style="font-size:9pt;"';
   $color1='#dfdfdf';
   $color2='#fefefe';
   $color3='#fdfdfd';
   $color='color1';
   $salida='<table border="1" cellspacing="1" cellpadding="1"  '.$estilo.' rules="all">';
   if (!is_array($matriz)){var_dump($matriz);return $matriz;}
      foreach($matriz as $key=>$value) {
         if(count($value)>0){
       //$color=($color=='color1')?'color2':'color1';
       if(is_array($value)||is_object($value)) {
           $salida.='<tr bgcolor="'.$color3."\"><td valign='top' bgcolor=\"$color1\">$key</td><td>";
           $salida.=ver2($value);
           $salida.="</td></tr>";
         } else {
            $salida.='<tr bgcolor="'.$color1."\"><td valign='top'>$key</td><td bgcolor=\"$color2\">$value</td></tr>";
         }

       }
   }
   $salida.='</table>';
   return $salida;
}

function ver($ss){
   if(!(is_array($ss)||is_object($ss))){
      echo $ss;
   }else{
      echo ver2($ss);
   }
}

function v(){
echo <<<ss2526
    <table border="1">
	<tr>
	    <td>SESSION
	    </td>
	    <td>REQUEST
	    </td>
	</tr>
	<tr>
	    <td>
ss2526;
   ver($_SESSION);
echo <<<ss2526
	    </td>
	    <td>REQUEST
ss2526;
   ver($_REQUEST);
echo <<<ss2526
	    </td>
	</tr>
    </table>
ss2526;
 }
