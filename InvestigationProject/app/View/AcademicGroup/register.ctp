<?php echo $this->Html->script('jquery.validate.min'); ?>
<h4><?php echo $page_name; ?></h4>
<?php echo $this->Form->create(''); ?>
<div class="small-12 medium-6 large-6 medium-centered large-centered columns form-content">
    <h5>Información del cuerpo académico</h5>
    <div class="row">
        <div class="column">
            <label>Nombre
                <?php
                echo $this->Form->input('name', array(
                    'label' => false,
                    'placeholder' => 'nombre',
                    'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
    <div class="row">
        <div class="column">
        <label>Líder
            <?php
            echo $this->Form->input('member_id', array(
                'label' => false,
                'placeholder' => 'líder del cuerpo académico',
                'class' => 'radius',
                'options' => $users,
                'empty' => 'líder'
                ));
                ?>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="column">
        <label>Nivel
            <?php
            echo $this->Form->input('level', array(
                'label' => false,
                'placeholder' => 'nivel',
                'class' => 'radius',
                'options' => $level_options,
                'empty' => 'nivel'
                ));
                ?>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <label>Descripción
                <?php
                echo $this->Form->input('description', array(
                    'label' => false,
                    'placeholder' => 'nivel',
                    'class' => 'radius',
                    'rows' => 3
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
<script type="text/javascript">
$(document).ready(function() {
    $('#AcademicGroupRegisterForm').validate({
        rules: {
            'data[AcademicGroup][name]': {required: true},
            'data[AcademicGroup][member_id]': {required: true},
            'data[AcademicGroup][level]': {required: true},
        }
    });
});
</script>