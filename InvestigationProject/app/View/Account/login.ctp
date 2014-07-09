<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Form->create('Login'); ?>
<div class="row">
    <div class="small-12 medium-6 large-6 columns">
        <div class="row">
            <div class="column">
                <label>Usuario
                    <?php
                    echo $this->Form->input('username', array(
                        'label' => false,
                        'placeholder' => 'Usuario'
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
                        'placeholder' => 'Contraseña'
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
    <div class="small-12 medium-6 large-6 columns center-text">
        <p>Texto Informativo</p>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#LoginLoginForm').validate({
            rules: {
                'data[Login][username]': {required: true},
                'data[Login][password]': {required: true}
            },
            messages: {
                'data[Login][username]': "El usuario es requerido",
                'data[Login][password]': "La contraseña es requerida"
            }
        });
    });
</script>