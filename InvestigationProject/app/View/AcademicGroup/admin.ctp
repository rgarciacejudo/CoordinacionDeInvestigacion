<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->css('jquery-ui/smoothness/jquery-ui'); ?>
<?php echo $this->Html->script('select2.min'); ?>
<?php echo $this->Html->css('select2.min'); ?>
<h4><?php echo $page_name; ?></h4>
<?php
echo $this->Html->link('Regresar', $this->request->referer(), array(
        'class' => 'button secondary tiny radius',
        'style' => 'margin-bottom: 1em;'
    )
);
?>
<div class="form-content">
    <?php echo $this->Form->create(''); ?>
    <div class="small-12 medium-6 large-6 columns">
        <h5>Información del cuerpo académico</h5>
        <?php
            echo $this->Form->input('id', array(
                'label' => false,
                'type' => 'hidden'
            ));
            ?>
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
            'label' => 'Guardar',
            'class' => 'button radius small right',
            'div' => array(
                'class' => 'columns'
            )
        ));
        ?>        
    </div>
    <div class="small-12 medium-6 large-6 columns">        
        <h5>Integrantes del cuerpo académico</h5>
        <div class="panel members-list">  
            <?php foreach ($members as $key => $member) { ?>
                <div class="member-container">
                    <input type="checkbox" id="Member<?php echo $member['Member']['id'];?>" 
                    data-member-id="<?php echo $member['Member']['id'];?>"
                    <?php echo empty($member['AcademicGroup']['academic_group_id']) ? '' : 'checked' ;?> /> 
                    <img class="th avatar" style="height:50px;width:50px" 
                        alt="<?php echo $member['User']['username'];?>"
                        src="<?php echo $this->webroot . (!empty($member['Member']['img_profile_path']) ? 
                            $member['Member']['img_profile_path'] : '/img/no_img_profile.png'); ?>"/>
                    <p class="member-username">
                        <?php echo $member['User']['username'] . '<br>' . $member['Member']['name'] . ' ' . 
                            $member['Member']['last_name'];?>
                    </p>
                </div>
            <?php } ?>            
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#AcademicGroupAdminForm').validate({
                rules: {
                    'data[AcademicGroup][name]': {required: true},
                    'data[AcademicGroup][member_id]': {required: true},
                    'data[AcademicGroup][level]': {required: true},                    
                    'data[AcademicGroup][user_id]': {required: true},
                }
            });                    

            function usersResultFormat(state){                
                console.log(state);
                if(!state.id) return state.text;
                var image = '<?php echo $this->webroot; ?>'
                return $('<img style="height: 50px; width:50px; display:inline-block;" class="th avatar" src="' +
                image + state.image + '"/>' + '<p style="display:inline-block;vertical-align:middle;margin:0;margin-left:1em;">' + state.text + '<br/>' + state.name + '</p>');
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

            $leader = $('#AcademicGroupUserId');
            $leader.val(<?php echo $this->request->data['Leader']['id']; ?>).trigger('change');

            function getUsers(){
                var users = new Array();

                var data = JSON.parse('<?php echo json_encode($users, JSON_FORCE_OBJECT); ?>');
                $.map(data, function(value, index){
                    users.push({
                        id: value.User.id,
                        text: value.Member.name + ' ' + (value.Member.last_name ? value.Member.last_name : ''),
                        image: value.Member.img_profile_path ? value.Member.img_profile_path : '/img/no_img_profile.png',
                        name: value.User.username
                    });
                });                
                return users;
            }

             //Eventos
            $('input[data-member-id]').change(function() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->webroot . "academic_group/memberadmin/" .
                            $academic_group['AcademicGroup']['id']; ?>/' +
                            $(this).attr('data-member-id') + '/' + $(this).is(':checked') + '.json',
                    success: function(response) {
                    }, 
                    error: function(response){
                        alert('Ocurrió un error intente más tarde');
                    }
                });
            });
        });
    </script>