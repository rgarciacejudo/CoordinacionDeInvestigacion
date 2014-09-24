
<li class="has-dropdown <?php echo $controller == 'academic_group' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Cuerpos académicos', array('controller' => 'academic_group', 'action' => 'index')); ?>
    <ul class="dropdown">
        <li>
            <?php echo $this->Html->link('Administrar', array('controller' => 'academic_group', 'action' => 'index', 'admin')); ?>
        </li>
        <li>
            <?php echo $this->Html->link('Consultar', array('controller' => 'academic_group', 'action' => 'index')); ?>
        </li>
        <li class="has-dropdown">
            <?php echo $this->Html->link('Investigadores', array('controller' => 'user', 'action' => 'index', 'members')); ?>
            <ul class="dropdown">
                <li>
                    <?php echo $this->Html->link('Registrar', array('controller' => 'user', 'action' => 'register')); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Consultar', array('controller' => 'user', 'action' => 'index', 'members')); ?>
                </li>
            </ul>
        </li>
    </ul>
</li>