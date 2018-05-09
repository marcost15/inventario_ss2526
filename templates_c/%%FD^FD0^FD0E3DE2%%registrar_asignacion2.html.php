<?php /* Smarty version 2.6.26, created on 2012-04-07 00:42:25
         compiled from registrar_asignacion2.html */ ?>
﻿<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cabecera.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="mensaje">
<p> Guardando Asignacion...Espere por favor, será redireccionado en 5 segundos...</p> 
</div>
<div><center><img src="./imagenes/procesando.png"/></center></div>
<?php echo '
<script type="text/javascript"> 
function redireccionar(){ 
  window.location="registrar_asignacion.php"; 
}  
setTimeout ("redireccionar()", 5000); //tiempo expresado en milisegundos 
</script> 
'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pie.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>