<?php echo $this->Html->script('jquery.validate.min'); ?>
<h4><?php echo $page_name; ?></h4>
<?php echo $this->Form->create(''); ?>
<div class="small-12 medium-6 large-6 medium-centered large-centered columns form-content">
  <?php if ($type === 'address') : ?>
    <?php
    echo $this->Form->input('name', array(
      'type' => 'hidden',
      'value' => 'address'
    ));
    ?>
  <?php else : ?>
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
  <?php endif ?>
    <div class="row">
        <div class="column">
            <label>Información <?php  echo $type === 'address' ? "de contacto" : ""; ?>
                <?php
                echo $this->Form->input('value', array(
                    'label' => false,
                    'class' => 'radius'
                ));
                ?>
            </label>
        </div>
    </div>
    <div class="row">
    	<?php
        echo $this->Form->end(array(
            'label' => 'Registrar',
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
		$('#ValueRegisterForm').validate({
            rules: {
                'data[Link][name]': {required: true},
                'data[Link][value]': {required: true}
            }
        });
	});
</script>
