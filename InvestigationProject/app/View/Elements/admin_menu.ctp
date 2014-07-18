<li class="has-dropdown <?php echo $controller == 'member' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Integrantes', array('controller' => 'member', 'action' => 'index')); ?>
    <ul class="dropdown">
    	<li>
    		<?php echo $this->Html->link('Agregar', array('controller' => 'member', 'action' => 'add')); ?>
    	</li>
    	<li>
	    	<?php echo $this->Html->link('Consultar', array('controller' => 'member', 'action' => 'index')); ?>
	    </li>
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'project' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Proyectos', array('controller' => 'project', 'action' => 'index')); ?>
    <ul class="dropdown">
    	<li>
    		<?php echo $this->Html->link('Agregar', array('controller' => 'project', 'action' => 'add')); ?>
    	</li>
    	<li>
	    	<?php echo $this->Html->link('Consultar', array('controller' => 'project', 'action' => 'index')); ?>
	    </li>
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'section' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Secciones', array('controller' => 'section', 'action' => 'index')); ?>
    <ul class="dropdown">
    	<li>
    		<?php echo $this->Html->link('Agregar', array('controller' => 'section', 'action' => 'add')); ?>
    	</li>
    	<li>
	    	<?php echo $this->Html->link('Consultar', array('controller' => 'section', 'action' => 'index')); ?>
	    </li>
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'network' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Redes Colaborativas', array('controller' => 'network', 
        'action' => 'index')); ?>
    <ul class="dropdown">
    	<li>
    		<?php echo $this->Html->link('Agregar', array('controller' => 'network', 'action' => 'add')); ?>
    	</li>
    	<li>
	    	<?php echo $this->Html->link('Consultar', array('controller' => 'network', 'action' => 'index')); ?>
	    </li>
    </ul>
</li>