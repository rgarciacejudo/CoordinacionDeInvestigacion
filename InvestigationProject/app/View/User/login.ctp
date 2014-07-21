<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Form->create('User'); ?>
<h4><?php echo $page_name; ?></h4>
<div class="small-12 medium-6 large-6 columns center-text">
    <div class="row" style="padding: 0 1em;">
        <p class="text-center">
            Inicia sesión y empieza a llenar tu perfil. 
            <br>
            Sube tus publicaciones y descubre todo el contenido de investigaciones
            que existen.
        </p>
    </div>
</div>

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
    <div class="row">
        <div class="column">
            <label>Contraseña
                <?php
                echo $this->Form->input('password', array(
                    'label' => false,
                    'placeholder' => 'contraseña',
                    'class' => 'radius'
                ));
                ?>
            </label>
        </div>
    </div> 
    <?php
    echo $this->Form->end(array(
        'label' => 'Entrar',
        'class' => 'button radius small right',
        'div' => array(
            'class' => 'columns'
        )
    ));
    ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#LoginLoginForm').validate({
            rules: {
                'data[User][username]': {required: true, email: true},
                'data[User][password]': {required: true}
            }
        });
    });
</script>