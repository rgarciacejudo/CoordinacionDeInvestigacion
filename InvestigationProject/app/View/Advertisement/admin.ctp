<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('jquery-ui/smoothness/jquery-ui'); ?>
<?php echo $this->Html->css('linecons'); ?>
<h4><?php echo $page_name; ?></h4>
<?php echo $this->Form->create(); ?>
<div class="small-12 medium-6 large-6 medium-centered large-centered columns form-content">
    <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
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
    <div class="row collapse">        
        <label>Fecha límite de visualización</label>
        <div class="small-3 large-2 columns">
            <span aria-hidden="true" class="radius-left prefix li_calendar"></span> 
        </div>
        <?php
        echo $this->Form->input('expiration_date', array(
            'type' => 'text',
            'label' => false,
            'placeholder' => 'fecha límite de anuncio',
            'class' => 'radius-right',
            'type' => 'text',
            'div' => array(
                'class' => 'small-9 large-10 columns'
            )
        ));
        ?>    
    </div>    
    <div class="row">
        <div class="column">
            <label>Descripción
                <?php
                echo $this->Form->input('description', array(
                    'label' => false,
                    'placeholder' => 'descripción',
                    'class' => 'radius'
                ));
                ?>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <label>URL
                <?php
                echo $this->Form->input('url', array(
                    'label' => false,
                    'placeholder' => 'url',
                    'class' => 'radius'
                ));
                ?>                
            </label>
        </div>
    </div>       
     <div class="row">
        <div class="column">
            <label>Permanente
                <?php
                echo $this->Form->input('is_permanent', array(
                    'label' => false
                ));
                ?>                
            </label>
        </div>
    </div>       
    <div class="row">
    	<?php
        echo $this->Form->end(array(
            'label' => 'Actualizar',
            'class' => 'button radius small',
            'div' => array(
                'class' => 'small-6 columns'
            )
        ));
        ?>    
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
        $('#AdvertisementExpirationDate').datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
		$('#AdvertisementAdminForm').validate({
            rules: {
                'data[Advertisement][name]': {required: true},         
                'data[Advertisement][expiration_date]': {required: true},
                'data[Advertisement][file_path]': {required: true}
            }
        });
	});
</script>