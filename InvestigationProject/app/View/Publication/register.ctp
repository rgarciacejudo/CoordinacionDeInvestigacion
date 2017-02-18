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
    <div class="small-12 medium-12 large-12 columns text-center">
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
    </div>
    <div class="large-offset-3 large-6 medium-offset-2 medium-8 small-12 columns hidden authors-container">
        <h5 class="text-center">Autores</h5>
        <div class="authors-cards">
            <div class="panel" data-author="0">
                <a class="me font-small">Yo</a> | <a href="#" data-reveal-id="myCaModal" class="font-small">De CA</a> | <a href="#" data-reveal-id="otherCaModal" class="font-small">Otro CA</a>                
                <?php
                echo $this->Form->input('Authors.0.member_id', array(
                    'label' => false,
                    'type' => 'hidden'
                ));
                ?>   
                <?php
                echo $this->Form->input('Authors.0.author', array(
                    'label' => 'Nombre',
                    'placeholder' => 'nombre',
                    'id' => null
                ));
                ?>   
                <a class="font-small add-author">Agregar autor</a>
            </div>
        </div>        
    </div>
    <div class="large-offset-3 large-6 medium-offset-2 medium-8 small-12 columns hidden members-container">
		<h5 class="text-center">Integrantes del CA que participaron</h5>
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
        <h5 class="text-center">Integrantes de otro CA que participaron</h5>
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
    <div class="large-offset-3 large-6 medium-offset-2 medium-8 small-12 columns publication-detail hidden">
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
            'label' => 'Registrar',
            'class' => 'button radius small right hidden',
            'style' => 'margin-top: 1em;',
            'id' => 'submitButton',
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
                    $member['Member']['last_name']; ?>" name="autor" type="radio" 
                    data-member="<?php echo $member['Member']['id'];?>"
                    id="Member<?php echo $member['Member']['id'];?>" />        
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

<div id="validateModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle2" aria-hidden="true" role="dialog">
    <h2 id="modalTitle2">Publicaciones Similares</h2>    
    <div class="similar-container"></div>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<div id="otherCaModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle2" aria-hidden="true" role="dialog">
    <h2 id="modalTitle2">Miembros de otro CA</h2>    
    <?php foreach ($members_other as $key => $member) { ?>        
        <div class="member-container">
            <input value="<?php echo $member['Member']['name'] . ' ' .
                    $member['Member']['last_name']; ?>" name="member" type="radio" 
                    data-member="<?php echo $member['Member']['id'];?>"
                    id="Member<?php echo $member['Member']['id'];?>" />        
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

<style>
.similar-container label {
    color: gray;
}
.similar-container label.title {
    color: #968411;
    font-weight: bold;
}    
.similar-container p {
    margin-bottom: 0;
    line-height: 1;
}
.similar-container h5 {
    font-weight: bold;
}
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $("#PublicationPublicationDate").datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});        

        $('.my-ca').click(myCA);
        $('.other-ca').click(otherCA);
        $('.font-small').click(setAuthor);
        $('.add-author').click(addAuthor);
        $('.me').click(me);

        var authorData = 0;
        var modelId = 0;

        function me() {
            var $author = $('[data-author="' + authorData + '"]');
            $author.find('input').val('<?php echo $this->Session->read('User.name') . ' ' . $this->Session->read('User.last_name') ?>');
        }

        function setAuthor() {         
            authorData = $(this).parent().data('author');
        }

        function addAuthor() {            
            //Clone DOM      
            var $panel =  $('[data-author]:first');            
            var $clon = $panel.clone();
            //Add close button
            var $close = $('<a>', {
                class: 'more-info'
            });
            $close.html('X');            
            $close.click(function(){
                $clon.remove();
            });
            $clon.prepend($close);
            //Set attrs
            $clon.attr('data-author', ++modelId);
            $clon.find('input[type="text"]').val('');
            $clon.find('input[type="text"]').attr('name', 'data[Authors][' + modelId + '][author]');
            $clon.find('input[type="hidden"]').val('');
            $clon.find('input[type="hidden"]').attr('name', 'data[Authors][' + modelId + '][member_id]');
            $('.authors-cards').append($clon);
            //Events
            $('.font-small').unbind('click');
            $('.me').unbind('click');
            $('.add-author').unbind('click');
            $('.my-ca').unbind('click');
            $('.other-ca').unbind('click');
            $('.font-small').click(setAuthor);
            $('.me').click(me);                    
            $('.add-author').click(addAuthor);
            $('.my-ca').click(myCA);
            $('.other-ca').click(otherCA);
        }       

        function myCA() {
            var $author = $('[data-author="' + authorData + '"]');
            $author.find('input:text').val($('input[name="autor"]:checked').val());
            $author.find('input:hidden  ').val($('input[name="autor"]:checked').data('member'));
            $('#myCaModal').foundation('reveal', 'close');
            $('input[name="autor"]').prop('checked', false);
        }

        function otherCA() {
            var $author = $('[data-author="' + authorData + '"]');
            $author.find('input:text').val($('input[name="member"]:checked').val());            
            $author.find('input:hidden').val($('input[name="member"]:checked').data('member'));            
            $('#otherCaModal').foundation('reveal', 'close');
            $('input[name="member"]').prop('checked', false);
        }

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

        $("input[name='data[Publication][section_id]']").change(function() {

            $('#submitButton').removeClass('hidden');
            $('.publication-detail').removeClass('hidden');

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
                    //show authors & members
                    if(response.authors === '1') {
                        $('.authors-container').removeClass('hidden');
                    } else {
                        $('.authors-container').addClass('hidden');
                    }

                    if(response.members === '1') {
                        $('.members-container').removeClass('hidden');
                    } else {
                        $('.members-container').addClass('hidden');
                    }

                    var fieldNo = 0;
                    $.each(response.fields, function() {
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

                                var that = this;
                                input.blur(function(){
                                    if($(this).val() !== '') {
                                        $.ajax({
                                            url: '<?php echo $this->webroot . "publication/validatefield";?>',
                                            data: {
                                                sectionFieldId: that.id,
                                                value: $(this).val()
                                            },
                                            error: function(){
                                                $('.publication-fields').removeClass('searching');                                            
                                            },
                                            success: function(response) {
                                                if(response.length > 0) {
                                                    var htmlcontent = `<label class="title">Se han encontrado ${response.length} publicación(es) similar(es), revísala(s) antes de continuar para no duplicar información.</label>`;
                                                    $.each(response, function(id) {
                                                        htmlcontent += `<div><h5>Detalle Publicación ${id + 1}</h5>`; 
                                                        $.each(this.Fields, function() {
                                                            htmlcontent += `
                                                                <label>${this.name}</label>
                                                                <p>${this.PublicationsSectionField.value}</p>
                                                            `
                                                        });
                                                        htmlcontent += '</div>';                                                        
                                                    });                                                
                                                    $('.similar-container').html(htmlcontent);
                                                    $('#validateModal').foundation('reveal', 'open');                                                    
                                                }                                                
                                            }
                                        });
                                    }
                                });
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
                    $('select.multiple').each(function() {
                        $(this).attr('size', $(this).children().length);
                    });
                }
            });
        });

        $("#PublicationSectionId").change();
    });
</script>
