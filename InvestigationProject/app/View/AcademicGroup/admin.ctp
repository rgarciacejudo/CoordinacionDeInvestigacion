<?php echo $this->Html->script('jquery.validate.min'); ?>
<h4><?php echo $page_name; ?></h4>
<div class="form-content">
    <?php echo $this->Form->create(''); ?>
    <div class="small-12 medium-6 large-6 columns">
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
                        'placeholder' => 'líder del cuerpo académico',
                        'class' => 'radius',
                        'options' => $users,
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
        <h5>Integrantes</h5>
        <div class="panel members-list">              
        </div>
    </div>
    <script type="text/javascript">
        var membersSelected = <?php echo json_encode($academic_group['Members']); ?>;                    
        $(document).ready(function() {
            $('#AcademicGroupAdminForm').validate({
                rules: {
                    'data[AcademicGroup][name]': {required: true},
                    'data[AcademicGroup][member_id]': {required: true},
                    'data[AcademicGroup][level]': {required: true},
                }
            });
                       
            $.ajax({
                url: '/CoordinacionDeInvestigacion/InvestigationProject/user/index/members.json',
                success: function(response){
                    var Users = response.users;
                    $.each(Users, function(){
                        //Crear input de integrante
                        var container = $('<div>', {
                           class: 'member-container' 
                        });
                        
                        var checkbox = $('<input>', {
                            type: 'checkbox',
                            id: 'Member.' + this.Member.id,
                            'data-member-id': this.Member.id
                        });
                        
                        var imageProfile = $('<img>', {
                           class: 'th avatar',
                           height: '50px',
                           width: '50px',
                           alt: this.User.username,
                           src: '/CoordinacionDeInvestigacion/InvestigationProject' + 
                                   (this.Member.img_profile_path !== null ? this.Member.img_profile_path : '/img/no_img_profile.png')
                        });
                        
                        var username = $('<p>', {
                            class: 'member-username'                            
                        });
                        
                        username.html(this.User.username + '<br>' + this.Member.name + ' ' + this.Member.last_name);                                               
                        
                        //Eventos
                        $(checkbox).change(function(){
                            $.ajax({
                                type: 'POST',
                                url: '/CoordinacionDeInvestigacion/InvestigationProject/academic_group/memberadmin/' +
                                        '<?php echo $academic_group['AcademicGroup']['id']; ?>/' +
                                        $(this).attr('data-member-id') + '/' + $(this).is(':checked') + '.json',
                                success: function(response){
                                    console.log(response);
                                }                               
                            });
                            console.log();
                        });
                        
                        //Agregar
                        container.append(checkbox);
                        container.append(imageProfile);
                        container.append(username);
                        $('.members-list').append(container);
                    });
                }
            });
        });
    </script>