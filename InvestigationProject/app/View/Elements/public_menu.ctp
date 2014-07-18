<li <?php echo $controller == 'member' ? 'class = "active"' : ''; ?>>
    <?php echo $this->Html->link('Integrantes', array('controller' => 'member', 'action' => 'index')); ?>
</li>
<li <?php echo $controller == 'project' ? 'class = "active"' : ''; ?>>
    <?php echo $this->Html->link('Proyectos', array('controller' => 'project', 'action' => 'index')); ?>
</li>
<li <?php echo $controller == 'section' ? 'class = "active"' : ''; ?>>
    <?php echo $this->Html->link('Secciones', array('controller' => 'section', 'action' => 'index')); ?>
</li>
<li <?php echo $controller == 'network' ? 'class = "active"' : ''; ?>>
    <?php echo $this->Html->link('Redes Colaborativas', array(
        'controller' => 'network', 
        'action' => 'index')); ?>
</li>