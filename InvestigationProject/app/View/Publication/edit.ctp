<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('jquery-ui/smoothness/jquery-ui'); ?>
<?php echo $this->Html->css('linecons'); ?>
<h4><?php echo $page_name; ?></h4>
<?php
echo $this->Html->link('Cancelar', $this->request->referer(), array(
        'class' => 'button secondary tiny radius',
        'style' => 'margin-bottom: 1em;'
    )
);
?>
<?php echo $this->Form->create('Publication', array('type' => 'file')); ?>
<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
<div class="form-content">
    <div class="large-offset-3 large-6 medium-offset-2 medium-8 small-12 columns authors-container <?php echo $section_options['Section']['with_authors'] === '1' ? '' : 'hidden'; ?>">
        <h5 class="text-center">Autores</h5>
        <div class="authors-cards">     
            <?php foreach ($this->request->data['Authors'] as $key => $author) { ?>
                <div class="panel" data-author="<?php echo $key; ?>">                    
                    <?php
                    echo $this->Form->input('Authors.' . $key . '.author', array(
                        'label' => 'Nombre',
                        'placeholder' => 'nombre',
                        'value' => $author['author'],
                        'readonly' => true,
                        'id' => null
                    ));
                    ?>                    
                </div>
            <?php } ?>            
        </div>        
    </div>    
	<div class="large-offset-3 large-6 medium-offset-2 medium-8 small-12 columns <?php echo $section_options['Section']['with_members'] === '1' ? '' : 'hidden'; ?>">
		<h5>Integrantes del CA que participaron</h5>
		<div class="over-member-container">
		<?php foreach ($members_ca as $key => $member) { ?>
			<div class="member-container">
				<input type="hidden" value="ca" name="data[Members][<?php echo $key;?>][type]" />
				<input type="checkbox" id="Member<?php echo $member['Member']['id'];?>"
                    name="data[Members][<?php echo $key;?>][member_id]"
                    value="<?php echo $member['Member']['id'];?>"
                    <?php echo isset($member['PublicationMembers']) && $member['PublicationMembers']['id'] !== null ? 'checked' : '';?> />
				<img class="th avatar" style="height:50px;width:50px"					
					src="<?php echo $this->webroot . (!empty($member['Member']['img_profile_path']) ?
						$member['Member']['img_profile_path'] : '/img/no_img_profile.png'); ?>"/>
				<p class="member-username">
					<?php echo $member['User']['username'] . '<br>' . $member['Member']['name'] . ' ' .
						$member['Member']['last_name'];?>
				</p>
			</div>
		<?php } ?>
		<?php if (count($members_ca) === 0) { ?>
		<p>No hay más integrantes</p>
		<?php } ?>
		</div>
        <h5>Integrantes de otro CA que participaron</h5>
        <div class="over-member-container">
        <?php foreach ($members_other as $key => $member) { ?>
            <div class="member-container">
                <input type="hidden" value="otro" name="data[Members][<?php echo $key + count($members_ca);?>][type]'" />
                <input type="checkbox" id="Member<?php echo $member['Member']['id'];?>"
                    name="data[Members][<?php echo $key + count($members_ca);?>][member_id]"
                    value="<?php echo $member['Member']['id'];?>"
                    <?php echo isset($member['PublicationMembers']) && $member['PublicationMembers']['id'] !== null ? 'checked' : '';?> />
                <img class="th avatar" style="height:50px;width:50px"                    
                    src="<?php echo $this->webroot . (!empty($member['Member']['img_profile_path']) ?
                        $member['Member']['img_profile_path'] : '/img/no_img_profile.png'); ?>"/>
                <p class="member-username">
                    <?php echo $member['User']['username'] . '<br>' . $member['Member']['name'] . ' ' .
                        $member['Member']['last_name'];?>
                </p>
            </div>
        <?php } ?>
        <?php if (count($members_other) === 0) { ?>
        <p>No hay más integrantes</p>
        <?php } ?>
        </div>
	</div>
    <div class="large-offset-3 large-6 medium-offset-2 medium-8 small-12 columns">
        <h5>Detalle de la publicación</h5>        
        <div class="publication-fields">
            <?php foreach ($publication['Fields'] as $key => $value) {
                echo $this->Form->input('Fields.'. $key .'.section_field_id', array('type' => 'hidden', 'value' => $value['id']));
                switch ($value['type']) {
                    case 'Texto':
                        echo '<label>'. $value['name'] .'</label>';
                        echo $this->Form->input('Fields.'.$key.'.value', array(
                            'class' => 'radius',
                            'type' => 'text',
                            'placeholder' => $value['name'],
                            'value' => $value['PublicationsSectionField']['value'],
                            'label' => false));
                        break;
                    case 'Fecha':
                        echo '<label>'. $value['name'] .'</label>';
                        echo '<div class="row collapse">';
                        echo '<div class="small-3 large-2 columns"><span aria-hidden="true" class="radius-left prefix li_calendar"></span></div>';
                        echo '<div class="small-9 large-10 columns"><input class="radius-right hasDatepicker" type="text" placeholder="'.$value['name'].'" value="'. $value['PublicationsSectionField']['value'] .'" name="data[Fields]['. $key .'][value]" id="Fields'. $key .'Value"></div>';
                        echo '</div>';
                        break;
                    case 'Casilla de verificación':
                        echo '<input class="radius" type="checkbox"  name="data[Fields]['. $key .'][value]" id="Fields'. $key .'Value"'. ($value['PublicationsSectionField']['value'] === 'on' ? 'checked' : '') .'/>';
                        echo '<label>'. $value['name'] .'</label>';
                        break;
                    case 'Lista desplegable':
                        echo '<label>'. $value['name'] .'</label>';
                        echo $this->Form->input('Fields.'.$key.'.value', array(
                            'type' => 'select',
                            'class' => 'radius',
                            'options' => array_combine(explode(',', $value['values']), explode(',', $value['values'])),
                            'placeholder' => $value['name'],
                            'selected' => $value['PublicationsSectionField']['value'],
                            'label' => false));
                        break;
                    case 'Selección múltiple':
                        echo '<label>'. $value['name'] .'</label>';
                        echo $this->Form->input('Fields.'. $key .'.value', array('type' => 'hidden', 'value' => $value['PublicationsSectionField']['value']));
                        echo $this->Form->input('Fields.'.$key.'.aux_value', array(
                            'type' => 'select',
                            'class' => 'multiple',
                            'data-input' => 'Fields'.$key.'Value',
                            'multiple' => 'multiple',
                            'options' => array_combine(explode(',', $value['values']), explode(',', $value['values'])),
                            'placeholder' => $value['name'],
                            'size' => 5,
                            'selected' => explode(',', $value['PublicationsSectionField']['value']),
                            'label' => false));
                        break;
                }?>
            <?php } ?>
        </div>
        <div class="row">
            <div class="column">
                <label>Archivo de publicación
                    <?php
                    echo $this->Form->input('file_path', array(
                        'label' => false,
                        'type' => 'file'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row collapse">
            <label>Fecha de Finalización / Obtención / Publicación</label>
            <div class="small-3 large-2 columns">
                <span aria-hidden="true" class="radius-left prefix li_calendar"></span>
            </div>
            <?php
            echo $this->Form->input('publication_date', array(
                'label' => false,
                'placeholder' => 'fecha de finalización / obtención / publicación',
                'class' => 'radius-right',
                'readonly' => 'readonly',
                'type' => 'text',
                'div' => array(
                    'class' => 'small-9 large-10 columns'
                )
            ));
            ?>
        </div>
    </div>
    <?php
        echo $this->Form->end(array(
            'label' => 'Actualizar',
            'class' => 'button radius small right',
            'style' => 'margin-top: 1em;',
            'div' => array(
                'class' => 'columns'
            )
        ));
        ?>
</div>

<!-- Modals -->
<div id="myCaModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <h2 id="modalTitle">Miembros de CA</h2>    
    <?php foreach ($members_ca as $key => $member) { ?>                
        <div class="member-container">
            <input value="<?php echo $member['Member']['name'] . ' ' .
                    $member['Member']['last_name']; ?>" name="autor" type="radio" id="Member<?php echo $member['Member']['id'];?>" />        
            <p class="member-username">
                <?php echo $member['User']['username'] . '<br>' . $member['Member']['name'] . ' ' .
                    $member['Member']['last_name'];?>
            </p>
        </div>
    <?php } ?>
    <?php if (count($members_ca) === 0) { ?>
    <p>No hay más integrantes</p>
    <?php } else { ?>
        <button class="my-ca button radius small right">Agregar</button>
    <?php } ?>   
</div>

<div id="otherCaModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle2" aria-hidden="true" role="dialog">
    <h2 id="modalTitle2">Miembros de otro CA</h2>    
    <?php foreach ($members_other as $key => $member) { ?>        
        <div class="member-container">
            <input value="<?php echo $member['Member']['name'] . ' ' .
                    $member['Member']['last_name']; ?>" name="member" type="radio" id="Member<?php echo $member['Member']['id'];?>" />        
            <p class="member-username">
                <?php echo $member['User']['username'] . '<br>' . $member['Member']['name'] . ' ' .
                    $member['Member']['last_name'];?>
            </p>
        </div>
    <?php } ?>
    <?php if (count($members_other) === 0) { ?>
    <p>No hay más integrantes</p>
    <?php } else { ?>
        <button class="other-ca button radius small right">Agregar</button>
    <?php } ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $("#PublicationPublicationDate").datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});        

        $('#PublicationRegisterForm').validate({
            rules: {
                'data[Publication][title]': {required: true},
                'data[Publication][description]': {required: true},
                'data[Publication][publication_date]': {required: true},
                'data[Publication][file]': {required: true},
                'data[Publication][section_id]': {required: true},
            },
            messages: {
                'data[Publication][section_id]': {
                    required: 'Este campo es requerido.'
                }
            }
        });


        $('select.multiple').each(function() {
            $(this).attr('size', $(this).children().length);
        });

        $('.multiple').change(function(){
            var input = $('#' + $(this).data('input'));
            if($(this).val()){
                $(input).val($(this).val().join(','));
            } else {
                $(input).val('');
            }
        });
    });
</script>
