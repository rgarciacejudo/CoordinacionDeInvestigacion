<?php echo $this->Html->script('jquery.validate.min'); ?>
<?php echo $this->Form->create('User'); ?>

<script type="text/javascript">
    var onloadCallback = function() {
        grecaptcha.render('recaptcha', {
            'sitekey' : '6Lc7XCgTAAAAAGsQKluXJ4QPV3zXyS64zfOA26a6'
        });
    };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

<h4><?php echo $page_name; ?></h4>
<div class="small-12 medium-6 large-6 columns center-text">
    <div class="row" style="padding: 0 1em;">
        <p class="text-center">
            Inicia sesión y empieza a llenar tu perfil. 
            <br>
            Sube tus publicaciones y descubre todo el contenido de investigaciones
            que existen.
        </p>
    </div>
</div>

<div class="small-12 medium-6 large-6 columns form-content">
    <div class="row">
        <div class="column">
            <label>Usuario
                <?php
                echo $this->Form->input('username', array(
                    'label' => false,
                    'placeholder' => 'usuario',
                    'class' => 'radius'
                ));
                ?>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <label>Contraseña
                <?php
                echo $this->Form->input('password', array(
                    'label' => false,
                    'placeholder' => 'contraseña',
                    'class' => 'radius'
                ));
                ?>
            </label>
        </div>
    </div>    
    <div id="recaptcha"></div>
    <label id="captcha-error" style="display:none;" class="error"></label>
    <div class="row">
        <div class="column">
            <?php
            echo $this->Html->link('¿Olvidó su contraseña?', array(
                'controller' => 'user',
                'action' => 'recover'
                    ), array(
                'style' => 'font-size: 12px;'
            ));
            echo $this->Form->end(array(
                'label' => 'Entrar',
                'class' => 'button radius small right',
                'div' => false
            ));
            ?>
        </div>
    </div>    
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#UserLoginForm').validate({
            rules: {
                'data[User][username]': {required: true, email: true},
                'data[User][password]': {required: true}                
            }
        });     

        $('#UserLoginForm').submit(function(e){            
            if(grecaptcha.getResponse() == '') {
                $('#captcha-error').css('display', 'block');
                $('#captcha-error').html('Este campo es requerido.');                
                e.preventDefault();
                return false;
            } else {
                return true;
            }         
        });      
    });
</script>