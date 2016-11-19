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
<div class="form-content">
    <div class="small-12 medium-6 large-6 columns">
        <h5>Detalle de la publicación</h5>
        <div class="row">
            <div class="column">
                <label>Sección</label>
                <div class="section-container">
                <?php foreach ($section_options as $key => $section) { ?>
                    <input type="radio"
                        id="PublicationSection<?php echo $section['Section']['id'];?>"
                        title="<?php echo $section['Section']['name'];?>"
                        name="data[Publication][section_id]"
                        value="<?php echo $section['Section']['id'];?>" />
                    <label for="PublicationSection<?php echo $section['Section']['id'];?>">
                        <img class="th avatar" style="height:50px;width:50px"
                            title="<?php echo $section['Section']['name'];?>"                            
                            src="<?php echo $this->webroot . (!empty($section['Section']['icon']) ?
                                $section['Section']['icon'] : '/img/no_img_section.png'); ?>"/>
                        <span><?php echo $section['Section']['name'];?></span>
                    </label>
                <?php } ?>
                </div>
            </div>
        </div>
        <br>
        <div class="publication-fields"></div>
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
    </div>
	<div class="small-12 medium-6 large-6 columns">
		<h5>Integrantes del CA que participaron</h5>
		<div class="over-member-container">
		<?php foreach ($members_ca as $key => $member) { ?>
			<div class="member-container">
				<input type="hidden" value="ca" name="data[Members][<?php echo $key;?>][type]" />
				<input type="checkbox" id="Member<?php echo $member['Member']['id'];?>"
                    name="data[Members][<?php echo $key;?>][member_id]" value="<?php echo $member['Member']['id'];?>" />
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
                    name="data[Members][<?php echo $key + count($members_ca);?>][member_id]" value="<?php echo $member['Member']['id'];?>"/>
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
    <?php
        echo $this->Form->end(array(
            'label' => 'Registrar',
            'class' => 'button radius small right',
            'style' => 'margin-top: 1em;',
            'div' => array(
                'class' => 'columns'
            )
        ));
        ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#PublicationPublishDate").datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});

        $('#PublicationRegisterForm').validate({
            rules: {
                'data[Publication][title]': {required: true},
                'data[Publication][description]': {required: true},
                'data[Publication][publish_date]': {required: true},
                'data[Publication][file]': {required: true},
                'data[Publication][section_id]': {required: true},
            },
            messages: {
                'data[Publication][section_id]': {
                    required: 'Este campo es requerido.'
                }
            }
        });

        $("input[name='data[Publication][section_id]']").change(function() {
            $('.publication-fields').html('');
            if(!$(this).val()){
                return;
            }
            $('.publication-fields').addClass('searching');
            $.ajax({
                url: '<?php echo $this->webroot . "section/getfields";?>',
                data: {
                    id: $(this).val()
                },
                error: function(){
                    $('.publication-fields').removeClass('searching');
                },
                success: function(response) {
                    var fieldNo = 0;
                    $.each(response, function() {
                        var container = $('.publication-fields');
                        var label = $('<label>', {});
                        label.html(this.name);
                        var hidden = $('<input>', {
                            class: 'radius',
                            type: 'hidden',
                            value: this.id,
                            name: 'data[Fields][' + fieldNo + '][section_field_id]',
                            id: 'Fields' + fieldNo + 'SectionFieldId'
                        });

                        container.append(hidden);

                        switch(this.type){
                            case 'Fecha':
                                var input = $('<input>', {
                                    class: 'radius',
                                    type: 'text',
                                    placeholder: this.name,
                                    name: 'data[Fields][' + fieldNo + '][value]',
                                    id: 'Fields' + fieldNo + 'Value'
                                });
                                var divCollapse = $('<div>', {
                                    class: 'row collapse'
                                });
                                divCollapse.append(label);

                                var divDate = $('<div>', {
                                    class: 'small-3 large-2 columns'
                                });

                                var dateIcon = $('<span>', {
                                    'aria-hidden': 'true',
                                    class: 'radius-left prefix li_calendar'
                                });

                                dateIcon.click(function(){
                                    $($($(this).parent()).next().children()[0]).datepicker('show');
                                });
                                divDate.append(dateIcon);
                                divCollapse.append(divDate);

                                var divInput = $('<div>', {
                                    class: 'small-9 large-10 columns'
                                });

                                input.removeClass('radius');
                                input.addClass('radius-right')

                                divInput.append(input);
                                divCollapse.append(divInput);

                                container.append(divCollapse);

                                $('#Fields' + fieldNo + 'Value').datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
                            break;
                            case 'Texto':
                                var input = $('<input>', {
                                    class: 'radius',
                                    type: this.type === 'Casilla de verificación' ? 'checkbox' : 'text',
                                    placeholder: this.name,
                                    name: 'data[Fields][' + fieldNo + '][value]',
                                    id: 'Fields' + fieldNo + 'Value'
                                });
                                container.append(label);
                                container.append(input);
                            break;
                            case 'Casilla de verificación':
                                var input = $('<input>', {
                                    class: 'radius',
                                    type: 'checkbox',
                                    placeholder: this.name,
                                    name: 'data[Fields][' + fieldNo + '][value]',
                                    id: 'Fields' + fieldNo + 'Value'
                                });
                                container.append(input);
                                container.append(label);
                            break;
                            case 'Lista desplegable':
                                var input = $('<select>', {
                                    class: 'radius',
                                    name: 'data[Fields][' + fieldNo + '][value]',
                                    id: 'Fields' + fieldNo + 'Value'
                                });
                                var data = this.values.split(',');
                                for(var val in data) {
                                    $("<option />", {value: data[val], text: data[val]}).appendTo(input);
                                }
                                container.append(label);
                                container.append(input);
                            break;
                            case 'Selección múltiple':
                                var select = $('<select>', {
                                    class: 'multiple',
                                    multiple: 'true',
                                    size: 6
                                });
                                var input = $('<input>', {
                                    name: 'data[Fields][' + fieldNo + '][value]',
                                    id: 'Fields' + fieldNo + 'Value',
                                    type: 'hidden'
                                });
                                var data = this.values.split(',');
                                for(var val in data) {
                                    $("<option />", {value: data[val], text: data[val]}).appendTo(select);
                                }

                                select.change(function(){
                                    if($(this).val()){
                                        $(input).val($(this).val().join(','));
                                    } else {
                                        $(input).val('');
                                    }
                                });

                                container.append(label);
                                container.append(select);
                                container.append(input);
                            break;
                        }
                        fieldNo++;
                    });
                    $('.publication-fields').removeClass('searching');
                }
            });
        });

        $("#PublicationSectionId").change();
    });
</script>
