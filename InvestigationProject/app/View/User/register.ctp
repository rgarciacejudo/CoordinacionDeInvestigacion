<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Form->create('Login'); ?>

<div class="small-12 medium-6 large-6 columns">
    <div class="row">
        <div class="column">
            <label>Usuario
                <?php
                echo $this->Form->input('username', array(
                    'label' => false,
                    'placeholder' => 'usuario'
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
                    'placeholder' => 'contraseña'
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
    <div class="row" style="padding: 0 1em;">
        <p>Texto Informativo</p>
    </div>
</div>