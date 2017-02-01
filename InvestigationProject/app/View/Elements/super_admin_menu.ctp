<li class="has-dropdown <?php echo $controller == 'academic_group' ? 'active' : ''; ?>">
    <a>Cuerpos académicos</a>
    <ul class="dropdown">
		<li class="has-dropdown">
            <a>Líderes C.A.</a>
            <ul class="dropdown">
                <li>
                    <?php echo $this->Html->link('Registrar', array('controller' => 'user', 'action' => 'register')); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Consultar', array('controller' => 'user', 'action' => 'index', 'leaders')); ?>
                </li>                
            </ul>
        </li>
        <li>
            <?php echo $this->Html->link('Registrar', array('controller' => 'academic_group', 'action' => 'register')); ?>
        </li>
        <li>
            <?php echo $this->Html->link('Consultar', array('controller' => 'academic_group', 'action' => 'index')); ?>
        </li>
        <li>
            <?php echo $this->Html->link('Reportes', array('controller' => 'publication', 'action' => 'report')); ?>
        </li>
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'section' ? 'active' : ''; ?>">
    <a>Secciones</a>
    <ul class="dropdown">
        <li>
            <?php echo $this->Html->link('Registrar', array('controller' => 'section', 'action' => 'register')); ?>
        </li>
        <li>
            <?php echo $this->Html->link('Consultar', array('controller' => 'section', 'action' => 'index')); ?>
        </li>
    </ul>
</li>
<li class="has-dropdown <?php echo $controller == 'link' || $controller == 'advertisement' ? 'active' : ''; ?>">
    <a>Anuncios</a>
    <ul class="dropdown">
        <li>
            <?php echo $this->Html->link('Registrar', array('controller' => 'advertisement', 'action' => 'register')); ?>
        </li>
        <li>
            <?php echo $this->Html->link('Consultar', array('controller' => 'advertisement', 'action' => 'index')); ?>
        </li>
        <li class="has-dropdown">
            <a>Links</a>
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
<li class="has-dropdown <?php echo $controller == 'value' ? 'active' : ''; ?>">
    <a>Información de Contacto</a>
    <ul class="dropdown">
        <?php if(!$address_info) : ?>
          <li>
              <?php echo $this->Html->link('Registrar', array('controller' => 'value', 'action' => 'register')); ?>
          </li>
        <?php else : ?>
          <li>
              <?php echo $this->Html->link('Editar', array('controller' => 'value', 'action' => 'admin', $address_info['Value']['id'], 'address')); ?>
          </li>
        <?php endif ?>
    </ul>
</li>
