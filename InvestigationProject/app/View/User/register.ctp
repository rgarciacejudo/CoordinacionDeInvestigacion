<?php echo $this->Html->script('jquery.validate.min'); ?>
<h4><?php echo $page_name; ?></h4>
<div class="small-12 medium-6 large-6 columns center-text">
    <div class="row" style="padding: 0 1em;">
        <p class="text-center">
            Ingresa el correo electrónico que servirá como nombre
			de usuario para crear la nueva cuenta 
			(<i>ej. usuario@cualquiera.mx</i>),
			los accesos serán enviados a éste para empezar a 
			utilizar el sistema.
        </p>
        <p>
            La cuenta creada tendrá las siguientes características:
            <br>
            <?php
            switch ($this->Session->read('Auth.User.role')) {
                case 'super_admin':
                    ?>
                <ul>
                    <li>Administrar un cuerpo académico</li>
                    <li>Administrar composición del cuerpo académico</li>
                    <li>Leer producción</li>
                    <li>Registrar producción</li>
                </ul>
                <?php
                break;
            case 'ca_admin':
                ?>
                <ul>
                    <li>Leer producción</li>
                    <li>Registrar producción</li>
                </ul>
                <?php
                break;
            default:
                ?>
                
                <?php
                break;
        }
        ?>
        </p>
    </div>
</div>
<?php echo $this->Form->create(''); ?>
<div class="small-12 medium-6 large-6 columns form-content">
    <div class="row">
        <div class="column">
            <label>Usuario
                <?php
                echo $this->Form->input('username', array(
                    'label' => false,
                    'placeholder' => 'usuario',
                    'class' => 'radius'
                ));
                ?>
            </label>
        </div>
    </div>
    <?php
    echo $this->Form->end(array(
        'label' => 'Registrar',
        'class' => 'button radius small right',
        'div' => array(
            'class' => 'columns'
        )
    ));
    ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#UserRegisterForm').validate({
            rules: {
                'data[User][username]': {required: true, email: true}
            }
        });
    });
</script>