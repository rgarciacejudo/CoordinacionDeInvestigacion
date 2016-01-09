<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('jquery-ui/smoothness/jquery-ui'); ?>
<?php echo $this->Html->script('select2.min'); ?>
<?php echo $this->Html->css('select2.min'); ?>
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
                echo $this->Form->input('user_id', array(
                    'label' => false,                    
                    'class' => 'radius',
                    'options' => array(),
                    'empty' => 'líder'
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
                    'data[AcademicGroup][user_id]': {required: true},
                    'data[AcademicGroup][level]': {required: true},
                }
            });

            function usersResultFormat(state){                
                console.log(state);
                if(!state.id) return state.text;
                return $('<img style="height: 50px; width:50px; display:inline-block;" class="th avatar" src="..' +
                state.image + '"/>' + '<p style="display:inline-block;vertical-align:middle;margin:0;margin-left:1em;">' + state.text + '<br/>' + state.name + '</p>');
            }

            function usersSelectionFormat(state){                
                console.log(state);
                if(!state.id) return state.text;
                return $('<p style="display:inline-block;vertical-align:middle;margin:0;margin-left:0.25em;">' + state.text + '</p>');
            }


            var users = getUsers();

            $('#AcademicGroupUserId').select2({
                data: users,
                placeholder: 'líder',
                templateSelection: usersSelectionFormat,
                templateResult: usersResultFormat,             
                language:{
                    noResults: function(){
                        return 'No hay resultados.';
                    }
                }
            });

            $('#AcademicGroupUserId').next().after($('#AcademicGroupUserId'));

            function getUsers(){
                var users = new Array();
                $.ajax({
                    async: false,
                    url: "../user/getusers",
                    dataType: "json",
                    data: {                    
                        role: 'ca_admin'
                    },
                    success: function(data) {                                                
                        console.log(data);
                        $(data).each(function(){
                            users.push({
                                id: this.id,
                                text: this.name,
                                image: this.image,
                                name: this.value
                            });
                        });                        
                    }
                });
                return users;
            }
        
        });
    </script>