<?php /* Smarty version 2.6.26, created on 2012-10-11 14:59:19
         compiled from rp_detalle_devoluciones.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cabecera.html", 'smarty_include_vars' => array('title' => "SS2526 - Articulos de la Devolucion")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="resultados">
<h3>DEVOLUCION</h3>
<p>
<div id = "indice">Fecha: <?php echo $this->_tpl_vars['devolucion']['fecha']; ?>
 - Tipo: <?php echo $this->_tpl_vars['devolucion']['tipo']; ?>
<br> Personal: <?php echo $this->_tpl_vars['devolucion']['personal_id']; ?>
<br>Total de Articulos:<?php echo $this->_tpl_vars['n']; ?>
</br>
		<?php unset($this->_sections['z']);
$this->_sections['z']['name'] = 'z';
$this->_sections['z']['loop'] = is_array($_loop=$this->_tpl_vars['indice']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['z']['show'] = true;
$this->_sections['z']['max'] = $this->_sections['z']['loop'];
$this->_sections['z']['step'] = 1;
$this->_sections['z']['start'] = $this->_sections['z']['step'] > 0 ? 0 : $this->_sections['z']['loop']-1;
if ($this->_sections['z']['show']) {
    $this->_sections['z']['total'] = $this->_sections['z']['loop'];
    if ($this->_sections['z']['total'] == 0)
        $this->_sections['z']['show'] = false;
} else
    $this->_sections['z']['total'] = 0;
if ($this->_sections['z']['show']):

            for ($this->_sections['z']['index'] = $this->_sections['z']['start'], $this->_sections['z']['iteration'] = 1;
                 $this->_sections['z']['iteration'] <= $this->_sections['z']['total'];
                 $this->_sections['z']['index'] += $this->_sections['z']['step'], $this->_sections['z']['iteration']++):
$this->_sections['z']['rownum'] = $this->_sections['z']['iteration'];
$this->_sections['z']['index_prev'] = $this->_sections['z']['index'] - $this->_sections['z']['step'];
$this->_sections['z']['index_next'] = $this->_sections['z']['index'] + $this->_sections['z']['step'];
$this->_sections['z']['first']      = ($this->_sections['z']['iteration'] == 1);
$this->_sections['z']['last']       = ($this->_sections['z']['iteration'] == $this->_sections['z']['total']);
?>
		<a href="?id=<?php echo $this->_tpl_vars['id']; ?>
&tipo=<?php echo $this->_tpl_vars['tipo']; ?>
&li=<?php echo $this->_tpl_vars['indice'][$this->_sections['z']['index']]['li']; ?>
">[<?php echo $this->_tpl_vars['indice'][$this->_sections['z']['index']]['li']; ?>
-<?php echo $this->_tpl_vars['indice'][$this->_sections['z']['index']]['ls']; ?>
]</a> <?php endfor; endif; ?>
		<a href="?id=<?php echo $this->_tpl_vars['id']; ?>
&tipo=<?php echo $this->_tpl_vars['tipo']; ?>
&accion=todos">[Todos]</a>
	</div>
</p>
<?php if ($this->_tpl_vars['tipo'] == 'SS'): ?>
<table class="enhancedtable" border="1" cellspacing="3" cellpadding="3" width="100%">
	<tr> 
		<th>&nbsp;</th>
		<th>Articulo</th>
		<th>Serial</th>
		<th>Cant</th>
		<th>Func</th>
	</tr>
	<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['datos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	    <th><?php echo $this->_sections['p']['index_next']; ?>
</th>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['arti_id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['serial']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['cantidad']; ?>
</td>
		<td><?php if ($this->_tpl_vars['datos'][$this->_sections['p']['index']]['funciona'] == '1'): ?>NO<?php else: ?>SI<?php endif; ?></td>
	</tr><?php endfor; endif; ?>
</table>
<?php endif; ?>
<?php if ($this->_tpl_vars['tipo'] == 'PROVEEDOR'): ?>
<table class="enhancedtable" border="1" cellspacing="3" cellpadding="3" width="100%">
	<tr> 
		<th>&nbsp;</th>
		<th>Articulo</th>
		<th>Serial</th>
		<th>Afiliado</th>
		<th>Comercio</th>
		<th>Fecha Evento</th>
		<th>Tipo Evento</th>
		<th>Reemplazo</th>
	</tr>
	<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['datos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	    <th><?php echo $this->_sections['p']['index_next']; ?>
</th>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['arti_id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['serial']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['afiliado']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['comercio']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['fecha_e']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['tipo']; ?>
</td>
		<?php if ($this->_tpl_vars['datos'][$this->_sections['p']['index']]['reemplazado']): ?>
			<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['reemplazado']; ?>
</td>
		<?php else: ?>
			<td>&nbsp;</td>
		<?php endif; ?>
	</tr><?php endfor; endif; ?>
</table>
<?php endif; ?>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pie.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>