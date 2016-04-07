<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('jquery-ui/smoothness/jquery-ui'); ?>
<h4><?php echo $page_name; ?></h4>
<?php    
echo $this->Html->link('Regresar', $this->request->referer(), array(
    'class' => 'button secondary tiny radius',
    'style' => 'margin-bottom: 1em;'
        )
); ?>
<?php echo $this->Form->create(''); ?>
<div class="small-12 medium-6 large-6 medium-centered large-centered columns form-content">
    <div class="row">
        <div class="column">
            <label>Institución
                <?php
                echo $this->Form->input('Institution.name', array(
                    'label' => false,
                    'placeholder' => 'institución',
                    'class' => 'radius',
                    'readonly' => '1'
                ));
                ?>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <label>Actividades
                <?php
                echo $this->Form->input('Experience.activities', array(
                    'label' => false,
                    'placeholder' => 'activiades',
                    'class' => 'radius'
                ));
                ?>
            </label>
        </div>
    </div>
    <label class="text-center">Periodo</label>
    <div class="row">
        <div class="column text-center">
            <label class="inline-block">De
                <?php
                echo $this->Form->input('Experience.from_date', array(
                    'label' => false,
                    'placeholder' => 'fecha de',
                    'class' => 'radius',
                    'type' => 'text'
                ));
                ?>
            </label>
            <label class="inline-block">A
                <?php
                echo $this->Form->input('Experience.to_date', array(
                    'label' => false,
                    'placeholder' => 'fecha a',
                    'class' => 'radius',
                    'type' => 'text'
                ));
                ?>
            </label>
        </div>
    </div>
    <?php
    echo $this->Form->end(array(
        'label' => 'Actualizar',
        'class' => 'button radius small right',
        'div' => array(
            'class' => 'columns'
        )
    ));
    ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#ExperienceFromDate").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
        $("#ExperienceToDate").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
        $('#ExperienceRegisterForm').validate({
            rules: {
                'data[Experience][institution]': {required: true},
                'data[Experience][activities]': {required: true}
            }
        });
    });
</script>