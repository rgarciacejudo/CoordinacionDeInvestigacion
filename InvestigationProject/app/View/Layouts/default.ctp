<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_name; ?>  - Observatorio de Investigaci&oacute;n</title>
        <link rel="shortcut icon" href="http://www.uaemex.mx/images/uniaemex.png">

        <meta description="Investigaci&oacute;n">
        <?php echo $this->Html->css(array('foundation', 'normalize', 'style')); ?>
        <?php echo $this->Html->script(array('vendor/modernizr', 'vendor/jquery', 'vendor/fastclick', 'foundation.min')); ?>
        <?php echo $this->Html->script('research-observatory'); ?>
    </head>
    <body>
        <div class="wrapper">   
            <header class="row">
                <figure>
                    <?php
                    echo $this->Html->link(
                         $this->Html->image('logo_principal.png', array(
                            'alt' => 'Observatorio de Investigación',
                            'width' => '100%')),
                        'http://www.uaemex.mx/', array('escape' => false));
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
                            <li <?php
                            echo $this->params['controller'] == 'home' ?
                                    'class = "active"' : '';
                            ?>>
                                    <?php
                                    echo $this->Html->link('Inicio', array(
                                        'controller' => 'home',
                                        'action' => 'display'));
                                    ?>
                            </li>
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
                                        <?php
                                        echo $this->Html->link($this->Session->read('Auth.User.username'), array(
                                            'controller' => 'user',
                                            'action' => 'edit'));
                                        ?>
                                    <ul class="dropdown">
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
                        <nav class="tab-bar transparent show-for-small">
                            <section class="left-small custom-side-bar">
                                <a class="left-off-canvas-toggle menu-icon"><span></span></a>
                            </section>          
                        </nav>        
                        <aside class="left-off-canvas-menu">
                            <ul class="off-canvas-list">                               
                            </ul>
                        </aside>
                        <section class="main-section">                        
<?php echo $this->Session->flash(); ?> 
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->fetch('content'); ?>
                            <!--                            <div class="medium-4 large-3 columns">
                                                <div class="hide-for-small">
                                                    <div class="sidebar">
                                                        <nav>
                                                            <ul class="side-nav">
                                                                <li class="heading">Secciones</li>
                                                                <li><a href="#">Texto</a></li>
                                                                <li><a href="#">Texto</a></li>                      
                                                                <li class="divider"></li>
                                                                <li class="heading">Proyectos</li>
                                                                <li><a href="#">Texto</a></li>
                                                                <li><a href="#">Texto</a></li>
                                                                <li class="divider"></li>
                                                                <li class="heading">Redes Colaborativas</li>
                                                                <li><a href="#">Texto</a></li>
                                                                <li><a href="#">Texto</a></li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="medium-8 large-9 columns">
                                                <br>
                                                <h4>The Psychohistorians</h4>
                                                <p>Set in the year 0 F.E. ("Foundation Era"), The Psychohistorians opens on Trantor, the capital of the 12,000-year-old Galactic Empire. Though the empire appears stable and powerful, it is slowly decaying in ways that parallel the decline of the Western Roman Empire. Hari Seldon, a mathematician and psychologist, has developed psychohistory, a new field of science and psychology that equates all possibilities in large societies to mathematics, allowing for the prediction of future events.</p>
                            
                                                <p>Using psychohistory, Seldon has discovered the declining nature of the Empire, angering the aristocratic members of the Committee of Public Safety, the de facto rulers of the Empire. The Committee considers Seldon's views and statements treasonous, and he is arrested along with young mathematician Gaal Dornick, who has arrived on Trantor to meet Seldon. Seldon is tried by the Committee and defends his beliefs, explaining his theories and predictions, including his belief that the Empire will collapse in 500 years and enter a 30,000-year dark age, to the Committee's members. </p>
                            
                                            </div>-->                       
                        </section>
                        <a class="exit-off-canvas"></a>
                        </section>
                        <footer>
                            <div class="row">                           
                                <div class="small-12 medium-6 large-3 columns">
                                    <ul class="footer-nav">
                                        <li><label>Contacto</label></li>
                                        <p>Dra. Rosa María Valdovinos Rosas<br> Facultad de Ingeniería<br> Cerro de Coatepec s/n, Ciudad Univesitaria Toluca, México.<br> Tel. (722) 2140855 ext. 1212</p>
                                    </ul>
                                </div>    
                                <div class="small-12 medium-6 large-3 columns">
                                    <ul class="footer-nav">
                                        <li><label>UAEM</label></li>
                                        <li><a href="#">Aviso de Privacidad</a></li>
                                        <li><a href="#">Directorio Telefónico</a></li>
                                        <li><a href="#">Gaceta Universitaria</a></li>
                                        <li><a href="#">Mapa CU</a></li>
                                        <li><a href="#">Sistemas Institucionales de Información Universitaria</a></li>
                                        <li><a href="#">Sitios Relacionados</a></li>
                                    </ul>
                                </div>
                                <div class="small-12 medium-6 large-3 columns">
                                    <ul class="footer-nav">
                                        <li><label>Enlaces</label></li>
                                        <li><a href="http://www.conacyt.mx/">CONACYT</a></li>
                                        <li><a href="http://promep.sep.gob.mx">PROMEP</a></li>                                      
                                    </ul>
                                </div>
                                <div class="small-12 medium-6 large-3 columns">
                                    <ul class="footer-nav">
                                        <li><label>Dirección</label></li>
                                        <p>Universidad Autónoma del Estado de México Instituto Literario # 100. Col. Centro C.P. 50000. Tel. (01-722) 2262300 Toluca, Estado de México. rectoria@uaemex.mx</p>
                                    </ul>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <script>
                        $(document).foundation();
                    </script>	
<?php echo $this->element('sql_dump'); ?>
                    </body>
                    </html>