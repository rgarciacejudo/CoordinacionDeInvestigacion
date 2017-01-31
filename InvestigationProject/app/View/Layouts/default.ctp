<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_name; ?>  - Observatorio de Investigaci&oacute;n</title>
    <link rel="shortcut icon" href="http://www.uaemex.mx/images/uniaemex.png">
    <meta description="Investigaci&oacute;n">
    <?php echo $this->Html->css(array('foundation', 'normalize', 'style?'.time())); ?>
    <?php echo $this->Html->script(array('vendor/modernizr', 'vendor/jquery', 'vendor/fastclick', 'foundation.min')); ?>
    <?php echo $this->Html->script('research-observatory'); ?>
</head>
<body>
    <div class="wrapper">
        <header class="row">
            <figure style="position:relative;">
                <?php
                echo $this->Html->link(
                 $this->Html->image('logo_principal.jpg', array(
                    'alt' => 'Observatorio de Investigación',
                    'width' => '100%')),
                 'http://www.uaemex.mx/', array('escape' => false));
                 ?>
				<?php
                echo $this->Html->link(
                 $this->Html->image('fi-logo.png', array(
                    'alt' => 'Facultad de Ingeniería',
                    'width' => '100%')),
                 'http://fi.uaemex.mx/portal/inicio/home.php', array(
					'escape' => false,
					'class' => 'filogo'));
                ?>
             </figure>
             <nav class="top-bar" style="margin-top: 5px;" data-topbar>
                <ul class="title-area">
                    <li class="name">
                        <h1><?php
                        echo $this->Html->link('Observatorio de Investigación', array(
                            'controller' => 'home',
                            'action' => 'display'
                            ));
                            ?></h1>
                        </li>
                        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                    </ul>

                    <section class="top-bar-section">
                        <ul class="left">
                            <?php if ($this->Session->read('Auth.User.id') == null) { ?>
                            <?php echo $this->element('public_menu'); ?>
                            <?php
                        } else {
                            switch ($this->Session->read('Auth.User.role')) {
                                case 'super_admin':
                                echo $this->element('super_admin_menu', array(
                                    'controller' => $this->params['controller'],
                                    'action' => $this->params['action']));
                                break;
                                case 'ca_admin':
                                echo $this->element('ca_admin_menu', array(
                                    'controller' => $this->params['controller']));
                                break;
                                case 'member':
                                echo $this->element('member_menu', array(
                                    'controller' => $this->params['controller']));
                                break;
                            }
                        }
                        ?>
                        <li class="divider" style="margin: 0 0.5em;"></li>
                        <?php if ($this->Session->read('Auth.User.id') != null) { ?>
                        <li class="has-dropdown <?php
                        echo $this->params['controller'] == 'user' && ($this->params['action'] == 'edit' or $this->params['action'] != 'manage') ?
                        'active' : '';
                        ?>">
                        <a><?php echo $this->Session->read('Auth.User.username'); ?></a>
                            <ul class="dropdown">
                                <li>
                                    <label style="padding:1em;">
                                        <?php switch ($this->Session->read('Auth.User.role')) {
                                            case 'super_admin':
                                            echo "Administrador";
                                            break;
                                            case 'ca_admin':
                                            echo "Líder Cuerpo Académico";
                                            break;
                                            case 'member':
                                            echo "Investigador";
                                            break;
                                        }?>
                                    </label>
                                </li>
                                <li>
                                    <?php
                                    echo $this->Html->link('Modificar perfil', array(
                                        'controller' => 'user',
                                        'action' => 'edit'));
                                        ?>
                                    </li>
                                    <li>
                                        <?php
                                        echo $this->Html->link('Ver perfil', array(
                                            'controller' => 'user',
                                            'action' => 'view'));
                                            ?>
                                        </li>
                                    </ul>
                                </li>
                                <?php } ?>
                                <li>
                                    <?php
                                    if ($this->Session->read('Auth.User.id') == null) {
                                        echo $this->Html->link('Iniciar sesión', array(
                                            'controller' => 'user',
                                            'action' => 'login'));
                                    } else {
                                        echo $this->Html->link('Cerrar sesión', array(
                                            'controller' => 'user',
                                            'action' => 'logout'));
                                    }
                                    ?>
                                </li>
                            </ul>
                        </section>
                    </nav>
                    <hr style="margin: 5px;"/>
                </header>
                <section class="row container">
                    <div class="off-canvas-wrap docs-wrap" data-offcanvas>
                        <div class="inner-wrap">
                            <section class="main-section">
                                <?php echo $this->Session->flash(); ?>
                                <?php echo $this->Session->flash('auth'); ?>
                                <?php echo $this->fetch('content'); ?>
                            </section>
                            <a class="exit-off-canvas"></a>
                        </div>
                    </div>
                </section>
                <footer>
                    <div class="row">
                        <div class="small-12 medium-6 large-3 columns">
                            <ul class="footer-nav">
                                <li><label>Contacto</label></li>
                                <p>
                                  <?php echo $address_info['Value']['value']; ?>
                                </p>
                            </ul>
                        </div>

                        <?php echo $this->element('footer-links'); ?>
                    </div>
                </footer>
            </div>
            <script>
            $(document).foundation();
            $(document).ready(function(){
                $('.wrapper > section.container').css('padding-bottom', $('footer > .row').height());
                $('footer').css('height', $('footer > .row').height());                
            });

            $(window).resize(function(){
                $('.wrapper > section.container').css('padding-bottom', $('footer > .row').height());
                $('footer').css('height', $('footer > .row').height());
            });
            </script>
            <?php echo $this->element('sql_dump'); ?>
        </body>
        </html>
