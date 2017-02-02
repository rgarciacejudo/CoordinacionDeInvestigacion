<h4><?php echo $page_name; ?></h4>

<div class="form-content">
    <div class="row">
        <div class="small-12 medium-offset-2 medium-8 large-offset-3 large-6 columns">
        <?php
            echo $this->Form->create('User');
        ?>
            <label>Usuario</label>
            <p>
                <label><b><?php echo $user['User']['username']; ?></b></label>
            </p>

            <label>Nombre
                <?php
                echo $this->Form->input('Member.name', array(
                    'label' => false,
                    'placeholder' => '',
                    'class' => 'radius',
                    'value' => $user['Member']['name']
                ));
                ?>
            </label>

            <label>Apellidos
                <?php
                echo $this->Form->input('Member.last_name', array(
                    'label' => false,
                    'placeholder' => '',
                    'class' => 'radius',
                    'value' => $user['Member']['last_name']
                ));
                ?>
            </label>
        <?php
            echo $this->Form->end(array(
                'label' => 'Actualizar',
                'class' => 'button tiny radius right',
                'div' => array(
                    'class' => 'columns'
                )
            ));
        ?>
        </div>
    </div>
</div>