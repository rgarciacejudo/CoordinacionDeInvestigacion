<li class="has-dropdown <?php echo $controller == 'academic_group' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Cuerpos Académicos', array('controller' => 'academic_group', 'action' => 'index')); ?>
    <ul class="dropdown">
        <li>
            <?php echo $this->Html->link('Registrar', array('controller' => 'academic_group', 'action' => 'register')); ?>
        </li>
        <li>
            <?php echo $this->Html->link('Consultar', array('controller' => 'academic_group', 'action' => 'index')); ?>
        </li>
        <li class="has-dropdown">
            <?php echo $this->Html->link('Líderes C.A.', array('controller' => 'user', 'action' => 'index', 'leaders')); ?>
            <ul class="dropdown">
                <li>
                    <?php echo $this->Html->link('Registrar', array('controller' => 'user', 'action' => 'register')); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Consultar', array('controller' => 'user', 'action' => 'index', 'leaders')); ?>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'section' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Secciones', array('controller' => 'section', 'action' => 'index')); ?>
    <ul class="dropdown">
        <li>
            <?php echo $this->Html->link('Registrar', array('controller' => 'section', 'action' => 'register')); ?>
        </li>
        <li>
            <?php echo $this->Html->link('Consultar', array('controller' => 'section', 'action' => 'index')); ?>
        </li>        
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'link' ? 'active' : ''; ?>">
    <?php echo $this->Html->link('Anuncios', array('controller' => 'advertisement', 'action' => 'index')); ?>
    <ul class="dropdown">
        <li>
            <?php echo $this->Html->link('Registrar', array('controller' => 'advertisement', 'action' => 'register')); ?>
        </li>
        <li>
            <?php echo $this->Html->link('Consultar', array('controller' => 'advertisement', 'action' => 'index')); ?>
        </li>
        <li class="has-dropdown">
            <?php echo $this->Html->link('Links', array('controller' => 'link', 'action' => 'index')); ?>
            <ul class="dropdown">
                <li>
                    <?php echo $this->Html->link('Registrar', array('controller' => 'link', 'action' => 'register')); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Consultar', array('controller' => 'link', 'action' => 'index')); ?>
                </li>
            </ul>
        </li>
    </ul>
</li>