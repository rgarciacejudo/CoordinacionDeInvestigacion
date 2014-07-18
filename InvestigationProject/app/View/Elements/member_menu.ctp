<li class="has-dropdown <?php echo $controller == 'profile' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Mi Perfil', array('controller' => 'profile', 'action' => 'index')); ?>
    <ul class="dropdown">
    	<li>
    		<?php echo $this->Html->link('Modificar', array('controller' => 'profile', 'action' => 'edit')); ?>
    	</li>
    	<li>
	    	<?php echo $this->Html->link('Ver', array('controller' => 'profile', 'action' => 'view')); ?>
	    </li>
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'file' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Mis Documentos', array('controller' => 'file', 'action' => 'index')); ?>
    <ul class="dropdown">
    	<li>
    		<?php echo $this->Html->link('Agregar', array('controller' => 'file', 'action' => 'add')); ?>
    	</li>
    	<li>
	    	<?php echo $this->Html->link('Consultar', array('controller' => 'file', 'action' => 'index')); ?>
	    </li>
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'project' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Mis Proyectos', array('controller' => 'project', 'action' => 'index')); ?>
    <ul class="dropdown">
    	<li>
    		<?php echo $this->Html->link('Agregar', array('controller' => 'project', 'action' => 'add')); ?>
    	</li>
    	<li>
	    	<?php echo $this->Html->link('Consultar', array('controller' => 'project', 'action' => 'index')); ?>
	    </li>
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'network' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Mis Redes', array('controller' => 'network', 'action' => 'index')); ?>
    <ul class="dropdown">
    	<li>
    		<?php echo $this->Html->link('Agregar', array('controller' => 'network', 'action' => 'add')); ?>
    	</li>
    	<li>
	    	<?php echo $this->Html->link('Consultar', array('controller' => 'network', 'action' => 'index')); ?>
	    </li>
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'section' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Mis Secciones', array('controller' => 'section', 'action' => 'index')); ?>
    <ul class="dropdown">
    	<li>
    		<?php echo $this->Html->link('Agregar', array('controller' => 'section', 'action' => 'add')); ?>
    	</li>
    	<li>
	    	<?php echo $this->Html->link('Consultar', array('controller' => 'section', 'action' => 'index')); ?>
	    </li>
    </ul>
</li>