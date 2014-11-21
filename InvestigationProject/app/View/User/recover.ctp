<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->script('autocompleter-ui'); ?>
<?php echo $this->Form->create('User'); ?>
<h4><?php echo $page_name; ?></h4>
<div class="small-12 medium-6 large-6 columns center-text">
    <div class="row" style="padding: 0 1em;">
        <p class="text-center">
            Ingresa tu nombre de usuario. 
            <br>
            Se enviará un correo con la información necesaria para restablecer
            tus accesos.
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
            <?php            
            echo $this->Form->end(array(
                'label' => 'Restablecer',
                'class' => 'button radius small right',
                'div' => false
            ));
            ?>
        </div>
    </div>    
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#LoginLoginForm').validate({
            rules: {
                'data[User][username]': {required: true, email: true}                
            }
        });
        $('#UserUsername').customAutocompleter();
    });
</script>