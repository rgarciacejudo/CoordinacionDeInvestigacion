<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_name; ?>  - Proyecto de Investigaci&oacute;n</title>
        <meta description="Investigaci&oacute;n">
        <?php echo $this->Html->css(array('foundation', 'normalize', 'style')); ?>
        <?php echo $this->Html->script(array('vendor/modernizr', 'vendor/jquery', 'vendor/fastclick', 'foundation.min')); ?>
    </head>
    <body>
        <header>
            <a href="/InvestigationProject/">
                <figure class="row relative">
                    <?php echo $this->Html->image('uaemex_logo.png', array('width' => '120', 'alt' => 'Universidad Autónoma del Estado de México')); ?>            
                    <span class="title-header">Proyecto de Investigaci&oacute;n</span>
                    <?php echo $this->Html->image('fiuaemex_logo.png', array('class' => 'absolute right-0', 'width' => '80', 'alt' => 'Facultad de Ingeniería')); ?>             
                </figure>
            </a>
        </header>
        <nav class="row top-bar" data-topbar>
            <ul class="title-area">
                <li class="name">
                    <h1><?php
                        echo $this->Html->link('Inicio', array(
                            'controller' => 'home',
                            'action' => 'index'
                        ));
                        ?></h1>
                </li>
                <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
            </ul>

            <section class="top-bar-section">
                <!-- Right Nav Section -->
                <ul class="right">
                    <li class="active"><?php
                        echo $this->Html->link(is_null($this->Session->read('Auth.User.id')) ?
                                        'Iniciar sesión' : $this->Session->read('Auth.User'), array(
                            'controller' => 'account',
                            'action' => 'login'
                        ));
                        ?></li>
                    <!--                    <li class="has-dropdown">
                                            <a href="#">Right Button Dropdown</a>
                                            <ul class="dropdown">
                                                <li><a href="#">First link in dropdown</a></li>
                                            </ul>
                                        </li>-->
                </ul>

                <!-- Left Nav Section -->
                <!--                <ul class="left">
                                    <li><a href="#">Left Nav Button</a></li>
                                </ul>-->
            </section>
        </nav>
        <section class="row">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </section>
        <footer>
            <section class="row center-text">
                <div class="small-12 medium-6 large-3 columns">                    
                    <ul class="side-nav">
                        <li class="heading">UAEM</li>
                        <li><a href="#">Aviso de privacidad</a></li>
                        <li><a href="#">Directorio Telef&oacute;nico</a></li>
                        <li><a href="#">Gaceta Universitaria</a></li>
                        <li><a href="#">Mapa CU</a></li>
                    </ul>
                </div>
                <div class="small-12 medium-6 large-3 columns">
                    <ul class="side-nav">
                        <li class="heading">FI UAEM</li>
                        <li><a href="#">Aviso de privacidad</a></li>
                        <li><a href="#">Bienvenida</a></li>
                        <li><a href="#">Misi&oacute;n</a></li>
                        <li><a href="#">Visi&oacute;n</a></li>                        
                    </ul>
                </div>
                <div class="small-12 medium-6 large-3 columns">
                    <ul class="side-nav">
                        <li class="heading">POSGRADO</li>
                        <li><a href="#">Link 1</a></li>
                        <li><a href="#">Link 2</a></li>
                        <li><a href="#">Link 3</a></li>
                        <li><a href="#">Link 4</a></li>
                    </ul>
                </div>
                <div class="small-12 medium-6 large-3 columns">
                    <ul class="side-nav">
                        <li class="heading">DIRECTORIO</li>
                        <li><a href="#">Link 1</a></li>
                        <li><a href="#">Link 2</a></li>
                        <li><a href="#">Link 3</a></li>
                        <li><a href="#">Link 4</a></li>
                    </ul>
                </div>
                <div class="small-12 medium-12 large-12 columns">
                    <span class="copyright-footer">&copy; <?php echo date("Y"); ?> Facultad de Ingenier&iacute;a. Todos los derechos reservados.</span>
                </div>
            </section>                    
        </footer>
        <script>
            $(document).foundation();
        </script>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>