<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('jquery-ui/smoothness/jquery-ui'); ?>
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
                echo $this->Form->input('user', array(
                    'type' => 'text',
                    'label' => false,
                    'placeholder' => 'líder del cuerpo académico',
                    'class' => 'radius'
                ));
                ?>
                <?php
                echo $this->Form->input('user_id', array(
                    'label' => false,
                    'type' => 'hidden'
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
                    'data[AcademicGroup][user]': {required: true},
                    'data[AcademicGroup][user_id]': {required: true},
                    'data[AcademicGroup][level]': {required: true},
                }
            });
            $(function() {
                $("#AcademicGroupUser").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "../user/getusers",
                            dataType: "json",
                            data: {
                                name: request.term,
                                role: 'ca_admin'
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    minLength: 2,
                    select: function(event, ui) {                                                
                        $("#AcademicGroupUserId").val(ui.item.id);
                    },
                    search: function(event, ui) {
                        $(this).addClass('searching');
                    },
                    response: function(event, ui) {
                        $(this).removeClass('searching');
                    }
                }).data("ui-autocomplete")._renderItem = function(ul, item) {                    
                    return $("<li>")
                            .data("item.autocomplete", item)
                            .append('<a>' + '<img style="height: 50px; width:50px; display:inline-block;" class="th avatar" src="..' +
                                (item.image !== null ? item.image :
                                        '/img/no_img_profile.png') + '" />' + 
                                        '<p style="display:inline-block;vertical-align:middle;margin:0;margin-left:1em;">' +
                                item.label + '<br>' +
                                item.name + '</p></a>')
                            .appendTo(ul);
                };
            });
        });
    </script>