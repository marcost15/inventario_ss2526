<?php /* Smarty version 2.6.26, created on 2012-04-07 00:22:43
         compiled from principal.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cabecera.html", 'smarty_include_vars' => array('title' => "SS2526 - Recordatorios")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo $this->_tpl_vars['f1']; ?>

<h3>Asuntos pendientes</h3>
<div id="resultados">
<table class="enhancedtable" border="1" cellspacing="3" cellpadding="3" width="100%">
	<tr>
		<th>Fecha</th>
		<th>Persona</th>
		<th>Asunto</th>
		<th>&nbsp;</th>
	</tr>
	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['lista']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
	<tr>
		<td><?php echo $this->_tpl_vars['lista'][$this->_sections['i']['index']]['fecha']; ?>
</td>
		<td><?php echo $this->_tpl_vars['lista'][$this->_sections['i']['index']]['nombre']; ?>
</td>
		<td><?php echo $this->_tpl_vars['lista'][$this->_sections['i']['index']]['asunto']; ?>
</td>
		<?php if ($this->_tpl_vars['lista'][$this->_sections['i']['index']]['permiso'] == 1): ?>
		<td><a href="eliminar_recordatorio.php?id=<?php echo $this->_tpl_vars['lista'][$this->_sections['i']['index']]['id']; ?>
"><img onmouseover='overlib("<strong>Asunto Concluido</strong>",WIDTH, 70)' src="./imagenes/eliminar.png" onmouseout='return nd();'/></a></td>
		<?php endif; ?>
	</tr>
	<?php endfor; endif; ?>
</table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pie.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>