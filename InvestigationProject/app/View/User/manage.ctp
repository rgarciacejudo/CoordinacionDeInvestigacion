<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Form->create(); ?>
<h4><?php echo $page_name; ?></h4>
<div class="small-12 medium-6 large-6 columns form-content">
    <h6>Cambiar contraseña</h6>
    <div class="row">
        <div class="column">
            <label>Contraseña actual
                <?php
                echo $this->Form->input('password', array(
                    'label' => false,
                    'placeholder' => 'contraseña actual',
                    'class' => 'radius'
                ));
                ?>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <label>Nueva contraseña
                <?php
                echo $this->Form->password('newpassword', array(
                    'label' => false,
                    'placeholder' => 'nueva contraseña',
                    'class' => 'radius'
                ));
                ?>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <label>Confirmar contraseña
                <?php
                echo $this->Form->password('confirm_newpassword', array(
                    'label' => false,
                    'placeholder' => 'confirmar contraseña',
                    'class' => 'radius'
                ));
                ?>
            </label>
        </div>
    </div>
    <?php        
    echo $this->Html->link('Cancelar', 'edit', array(
        'class' => 'button radius small secondary'
    ));
    echo $this->Form->end(array(
        'label' => 'Guardar',
        'class' => 'button radius small right',
        'div' => false        
    ));
    ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#UserManageForm').validate({
            rules: {
                'data[User][password]': {required: true},
                'data[User][newpassword]': {required: true},
                'data[User][confirm_newpassword]': {required: true, equalTo: '#UserNewpassword'}
            }
        });
    });
</script>