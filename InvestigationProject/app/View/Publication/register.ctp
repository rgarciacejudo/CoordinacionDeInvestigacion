<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('jquery-ui/smoothness/jquery-ui'); ?>
<?php echo $this->Html->css('linecons'); ?>
<h4><?php echo $page_name; ?></h4>
<?php echo $this->Form->create('Publication', array('type' => 'file')); ?>
<div class="form-content">
    <div class="small-12 medium-6 large-6 columns">
        <h5>Información de la publicación</h5>
        <div class="row">
            <div class="column">
                <label>Título
                    <?php
                    echo $this->Form->input('Publication.title', array(
                        'label' => false,
                        'placeholder' => 'título',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label>Descripción
                    <?php
                    echo $this->Form->input('Publication.description', array(
                        'label' => false,
                        'placeholder' => 'descripción',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="row collapse">            
            <label>Fecha de publicación</label>
            <div class="small-3 large-2 columns">
                <span aria-hidden="true" class="radius-left prefix li_calendar"></span> 
            </div>
            <?php
            echo $this->Form->input('Publication.publish_date', array(
                'type' => 'text',
                'label' => false,
                'placeholder' => 'fecha de publicación',
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
        <h5>Detalle de la publicación</h5>
        <div class="row">
            <div class="column">
                <label>Sección
                    <?php
                    echo $this->Form->input('Publication.section_id', array(
                        'label' => false,
                        'options' => $section_options,
                        'empty' => 'sección',
                        'placeholder' => 'sección',
                        'class' => 'radius'
                    ));
                    ?>
                </label>
            </div>
        </div>
        <div class="publication-fields"></div>
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
            }
        });

        $("#PublicationSectionId").change(function() {
            $('.publication-fields').html('');
            if(!$(this).val()){
                return;
            }
            $('#PublicationSectionId').addClass('searching');
            $.ajax({
                url: '<?php echo $this->webroot . "section/getfields";?>',
                data: {
                    id: $(this).val()
                },
                error: function(){
                    $('#PublicationSectionId').removeClass('searching');
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
                    $('#PublicationSectionId').removeClass('searching');
                }
            });
        });

        $("#PublicationSectionId").change();
    });
</script>