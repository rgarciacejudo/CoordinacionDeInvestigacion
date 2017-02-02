<h4><?php echo $page_name; ?></h4>

<div class="form-content">
    <div class="row">
        <div class="small-12 medium-12 large-12 columns">
            <table style="width:100%;">
                <thead>
                    <tr>
                        <th>Imagen de perfil</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($members as $key => $member) :?>	
                        <tr>
                            <td>
                                <img class="th avatar" style="height:50px;width:50px"					
                                    src="<?php echo $this->webroot . (!empty($member['Member']['img_profile_path']) ?
                                    $member['Member']['img_profile_path'] : '/img/no_img_profile.png'); ?>"/>
                            </td>
                            <td>
                                <?php echo $member['User']['username']; ?>
                            </td>
                            <td>
                                <?php echo $member['Member']['name'] . ' ' . $member['Member']['last_name']; ?>
                            </td>
                            <td>
                                <?php echo $this->Html->link('Editar', array('controller' => 'user', 'action' => 'edituser', $member['User']['id'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>