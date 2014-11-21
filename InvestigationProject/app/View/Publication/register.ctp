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
            'div' => array(
                'class' => 'columns'
            )
        ));
        ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#PublicationPublishDate").datepicker({dateFormat: "yy-mm-dd"});

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
            $('#PublicationSectionId').toggleClass('searching');
            $.ajax({
                url: '../section/getfields',
                data: {
                    id: $(this).val()
                },
                error: function(){
                    $('#PublicationSectionId').toggleClass('searching');
                },
                success: function(response) {
                    var fieldNo = 0;
                    $.each(response, function() {
                        var container = $('.publication-fields');
                        var label = $('<label>', {});
                        label.html(this.name);
                        var input = $('<input>', {
                            class: 'radius',
                            type: this.type === 'Casilla de verificación' ? 'checkbox' : 'text',
                            placeholder: this.name,
                            name: 'data[PublicationsSectionField][' + fieldNo + '][value]',
                            id: 'PublicationsSectionField' + fieldNo + 'Value'
                        });
                        var hidden = $('<input>', {
                            class: 'radius',
                            type: 'hidden',
                            value: this.id,
                            name: 'data[PublicationsSectionField][' + fieldNo + '][section_field_id]',
                            id: 'PublicationsSectionField' + fieldNo + 'SectionFieldId'
                        });

                        container.append(label);
                        container.append(hidden);
                        container.append(input);
                        if (this.type === 'Fecha') {
                            $('#PublicationsSectionField' + fieldNo + 'Value').datepicker({dateFormat: "yy-mm-dd"});
                        }
                        fieldNo++;
                    });
                    $('#PublicationSectionId').toggleClass('searching');
                }
            });
        });
    });
</script>