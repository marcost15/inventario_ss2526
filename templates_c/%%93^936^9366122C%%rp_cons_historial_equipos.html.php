<?php /* Smarty version 2.6.26, created on 2012-10-11 14:59:46
         compiled from rp_cons_historial_equipos.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cabecera.html", 'smarty_include_vars' => array('title' => "SS2526 - Historial Equipo")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="resultados">
<h3>HISTORIAL DE MOVIMIENTO DE EQUIPO</h3>
<?php if ($_SESSION['mensaje']): ?>
</p>
<div class="mensaje"><?php echo $_SESSION['mensaje']; ?>
</div>
<?php endif; ?>
<table border="0">
	<tr> 
		<th>Articulo</th>
		<td><?php echo $this->_tpl_vars['articulo']; ?>
</td>
	</tr>
	<tr> 
		<th>Serial</th>
		<td><?php echo $this->_tpl_vars['id']; ?>
</td>
	</tr>
</table>
<p>
</p>
<?php if ($this->_tpl_vars['entradas']): ?>
<h3>ENTRADA</h3>
<table class="enhancedtable" cellspacing="0" cellpadding = "3" border="1" align="center" width="100%">
	<tr> 
		<th>Fecha</th>
		<th>Proveedor</th>
		<th>Personal</th>
		<th>Deposito</th>
		<th>Observacion</th>
	</tr>
	<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['entradas']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
	<tr>
	    <td><?php echo $this->_tpl_vars['entradas'][$this->_sections['p']['index']]['fecha']; ?>
</td>
		<td><?php echo $this->_tpl_vars['entradas'][$this->_sections['p']['index']]['proveedor_id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['entradas'][$this->_sections['p']['index']]['personal_id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['entradas'][$this->_sections['p']['index']]['deposito_id']; ?>
</td>
		<?php if ($this->_tpl_vars['entradas'][$this->_sections['p']['index']]['observacion']): ?>
			<td><?php echo $this->_tpl_vars['entradas'][$this->_sections['p']['index']]['observacion']; ?>
</td>
		<?php else: ?>
			<td>&nbsp;</td>
		<?php endif; ?>
	</tr><?php endfor; endif; ?>
</table>
<?php endif; ?>
<p>
</p>
<?php if ($this->_tpl_vars['asignacion']): ?>
<h3>ASIGNACION</h3>
<table class="enhancedtable" cellspacing="0" cellpadding = "3" border="1" align="center" width="100%">
	<tr> 
		<th>Fecha</th>
		<th>Entrega</th>
		<th>Recibe</th>
		<th>Observacion</th>
	</tr>
	<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['asignacion']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
	<tr>
	    <td><?php echo $this->_tpl_vars['asignacion'][$this->_sections['p']['index']]['fecha']; ?>
</td>
		<td><?php echo $this->_tpl_vars['asignacion'][$this->_sections['p']['index']]['entrepersonal_id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['asignacion'][$this->_sections['p']['index']]['recibepers_id']; ?>
</td>
		<?php if ($this->_tpl_vars['asignacion'][$this->_sections['p']['index']]['observacion']): ?>
			<td><?php echo $this->_tpl_vars['asignacion'][$this->_sections['p']['index']]['observacion']; ?>
</td>
		<?php else: ?>
			<td>&nbsp;</td>
		<?php endif; ?>
	</tr><?php endfor; endif; ?>
</table>
<?php endif; ?>
<p>
</p>
<?php if ($this->_tpl_vars['eventos']): ?>
<h3>REEMPLAZO - INSTALACION - DESINSTALACION</h3>
<table class="enhancedtable" cellspacing="0" cellpadding = "3" border="1" align="center" width="100%">
	<tr> 
		<th>Fecha Evento</th>
		<th>Fecha Registro</th>
		<th>Afiliado</th>
		<th>Comercio</th>
		<th>Personal</th>
		<th>Tipo</th>
		<th>Reemplazo</th>
		<th>Observacion</th>
	</tr>
	<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['eventos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
	<tr>
	    <td><?php echo $this->_tpl_vars['eventos'][$this->_sections['p']['index']]['fecha_e']; ?>
</td>
		<td><?php echo $this->_tpl_vars['eventos'][$this->_sections['p']['index']]['fecha']; ?>
</td>
		<td><?php echo $this->_tpl_vars['eventos'][$this->_sections['p']['index']]['afiliado']; ?>
</td>
		<td><?php echo $this->_tpl_vars['eventos'][$this->_sections['p']['index']]['comercio_id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['eventos'][$this->_sections['p']['index']]['personal_id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['eventos'][$this->_sections['p']['index']]['tipo']; ?>
</td>
		<?php if ($this->_tpl_vars['eventos'][$this->_sections['p']['index']]['reemplazado']): ?>
			<?php if ($this->_tpl_vars['eventos'][$this->_sections['p']['index']]['reemplazado']): ?>
				<td><?php echo $this->_tpl_vars['eventos'][$this->_sections['p']['index']]['reemplazado']; ?>
</td>
			<?php else: ?>
				<td>&nbsp;</td>
			<?php endif; ?>
		<?php else: ?>
			<?php if ($this->_tpl_vars['eventos'][$this->_sections['p']['index']]['reemplazo']): ?>
				<td><?php echo $this->_tpl_vars['eventos'][$this->_sections['p']['index']]['reemplazo']; ?>
</td>
			<?php else: ?>
				<td>&nbsp;</td>
			<?php endif; ?>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['eventos'][$this->_sections['p']['index']]['observacion']): ?>
			<td><?php echo $this->_tpl_vars['eventos'][$this->_sections['p']['index']]['observacion']; ?>
</td>
		<?php else: ?>
			<td>&nbsp;</td>
		<?php endif; ?>
	</tr><?php endfor; endif; ?>
</table>
<?php endif; ?>
<p>
</p>
<?php if ($this->_tpl_vars['devoluciones']): ?>
<h3>DEVOLUCION A STOCK - PROVEEDOR</h3>
<table class="enhancedtable" cellspacing="0" cellpadding = "3" border="1" align="center" width="100%">
	<tr> 
		<th>Fecha</th>
		<th>Personal</th>
		<th>Tipo</th>
	</tr>
	<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['devoluciones']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
	<tr>
	    <td><?php echo $this->_tpl_vars['devoluciones'][$this->_sections['p']['index']]['fecha']; ?>
</td>
		<td><?php echo $this->_tpl_vars['devoluciones'][$this->_sections['p']['index']]['personal_id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['devoluciones'][$this->_sections['p']['index']]['tipo']; ?>
</td>
	</tr><?php endfor; endif; ?>
</table>
<?php endif; ?>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pie.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>