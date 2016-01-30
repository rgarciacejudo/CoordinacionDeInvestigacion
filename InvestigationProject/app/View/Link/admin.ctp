<?php echo $this->Html->script('jquery.validate.min'); ?>
<h4><?php echo $page_name; ?></h4>
<?php echo $this->Form->create(''); ?>
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
    <div class="row">
        <div class="column">
            <label>Texto de link
                <?php
                echo $this->Form->input('display_name', array(
                    'label' => false,
                    'placeholder' => 'texto de link',
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
		$('#LinkAdminForm').validate({
            rules: {
                'data[Link][name]': {required: true},
                'data[Link][display_name]': {required: true},
                'data[Link][url]': {required: true}
            }
        });
	});
</script>